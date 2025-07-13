<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get order statistics
        $orderStats = Order::getOrderSummary();
        
        // Get menu count
        $menuCount = Menu::active()->count();
        
        // Get user count (you can add User model later)
        $userCount = 3; // Placeholder for now
        
        // Get most sold menu items by category for today
        $topFoodItems = $this->getTopMenuItemsByCategory(Menu::KATEGORI_MAKANAN);
        $topDrinkItems = $this->getTopMenuItemsByCategory(Menu::KATEGORI_MINUMAN);
        
        return view('dashboard.index', compact(
            'orderStats', 
            'menuCount', 
            'userCount', 
            'topFoodItems', 
            'topDrinkItems'
        ));
    }
    
    private function getTopMenuItemsByCategory($category)
    {
        return OrderItem::select(
                'menus.id',
                'menus.nama',
                'menus.gambar',
                'menus.harga',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('menus.kategori', $category)
            ->where('menus.status', true)
            ->whereDate('orders.created_at', today())
            ->groupBy('menus.id', 'menus.nama', 'menus.gambar', 'menus.harga')
            ->orderBy('total_sold', 'desc')
            ->limit(3)
            ->get();
    }
} 