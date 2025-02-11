<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if ($user->role === 'admin') {
            $orders = Order::latest()->get(); 
            $totalOrders = Order::count();
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->get();
            $totalOrders = $orders->count();
        }
        $data['jumlah_order'] = $totalOrders;
        return view('dashboard', $data);
    }
}
