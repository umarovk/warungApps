<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;

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
        
        return view('dashboard.index', compact('orderStats', 'menuCount', 'userCount'));
    }
} 