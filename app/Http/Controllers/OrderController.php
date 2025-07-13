<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Get all active menus grouped by category, ordered by urutan
        $categories = Menu::active()
            ->ordered()
            ->get()
            ->groupBy('kategori');
        
        return view('orders.create', compact('categories'));
    }

    public function exportCsv()
    {
        $orders = Order::with('items.menu')->orderBy('created_at', 'desc')->get();
        
        $filename = 'orders_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV Headers
            fputcsv($file, [
                'ID Order',
                'Nama Pelanggan',
                'Nomor Meja',
                'Status',
                'Total',
                'Catatan',
                'Tanggal Order',
                'Item Menu',
                'Jumlah',
                'Harga Satuan',
                'Subtotal'
            ]);

            // CSV Data
            foreach ($orders as $order) {
                if ($order->items->count() > 0) {
                    foreach ($order->items as $item) {
                        fputcsv($file, [
                            $order->id,
                            $order->customer_name,
                            $order->table_number ?: '-',
                            $order->status_label,
                            $order->formatted_total,
                            $order->notes ?: '-',
                            $order->created_at->format('d/m/Y H:i'),
                            $item->menu->nama,
                            $item->quantity,
                            'Rp ' . number_format($item->price, 0, ',', '.'),
                            'Rp ' . number_format($item->subtotal, 0, ',', '.')
                        ]);
                    }
                } else {
                    // Order without items
                    fputcsv($file, [
                        $order->id,
                        $order->customer_name,
                        $order->table_number ?: '-',
                        $order->status_label,
                        $order->formatted_total,
                        $order->notes ?: '-',
                        $order->created_at->format('d/m/Y H:i'),
                        '-',
                        '-',
                        '-',
                        '-'
                    ]);
                }
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|json',
            'total' => 'required|numeric|min:0'
        ]);

        $items = json_decode($request->items, true);
        
        if (empty($items)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada item yang dipilih'
            ]);
        }

        // Validate items
        foreach ($items as $item) {
            if (!isset($item['id']) || !isset($item['quantity']) || $item['quantity'] <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data item tidak valid'
                ]);
            }
        }

        try {
            // Create order
            $order = Order::create([
                'customer_name' => 'Pelanggan',
                'table_number' => 1,
                'total' => $request->total,
                'status' => Order::STATUS_PENDING
            ]);

            // Create order items
            foreach ($items as $item) {
                $menu = Menu::find($item['id']);
                if ($menu) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'quantity' => $item['quantity'],
                        'price' => $menu->harga,
                        'subtotal' => $menu->harga * $item['quantity']
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat order: ' . $e->getMessage()
            ]);
        }
    }
} 