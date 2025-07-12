<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Get all active menus grouped by category
        $categories = Menu::active()
            ->orderBy('kategori')
            ->orderBy('nama')
            ->get()
            ->groupBy('kategori');
        
        return view('orders.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'nullable|integer|min:1',
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
                'customer_name' => $request->customer_name,
                'table_number' => $request->table_number,
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