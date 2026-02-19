<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your Cart is empty');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $order = $user->orders()->create([
            'user_id' => $user->id,
            'user_address_id' => session('selected_address_id'),
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'vendor_id' => $item->product->vendor_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        $user->cartItems()->delete();

        return redirect()->route('order.success', $order)->with('success', 'Order placed successfully');
    }

    public function success(Order $order) 
    {

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'address');

        return view('orders.success', compact('order'));
    }

    public function index()
    {
        $orders = auth()->user()->orders()
                ->with('address') 
                ->latest()        
                ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order) 
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'address');

        return view('orders.show', compact('order'));
    }
}
