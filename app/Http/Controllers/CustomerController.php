<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = $user->orders()->with('items.product')->latest()->get();

        $totalItems = $orders->sum(fn($order) => $order->items->sum('quantity'));
        $totalSpent = $orders->sum('total_price');

        return view('dashboard.index', compact('orders', 'totalItems', 'totalSpent'));
    }
}
