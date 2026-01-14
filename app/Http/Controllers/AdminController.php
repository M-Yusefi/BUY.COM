<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;

class AdminController extends Controller
{
    // Admin dashboard view
    public function dashboard() 
    {
        $vendors = count(Vendor::all());
        $categories = count(Category::all());
        $products = count(Product::all());
        $orders = count(Order::all());
        $transaction = count(Transaction::all());

        return view('admin.dashboard', [
            'vendors'     => $vendors,
            'categories'  => $categories,
            'products'    => $products,
            'orders'      => $orders,
            'transaction' => $transaction
        ]);
    }

    // Vendors overview
    public function vendorsOverview() 
    {
        $vendors = Vendor::all();
        return view('admin.vendor', compact('vendors'));
    }
    
    // Vendors status function
    public function venodrStatus(Request $request, Vendor $vendor) 
    {
        $validated = $request->validate([ 
            'status' => ['required', 'string', 'in:pending,active,blocked'],
        ]);    

        $vendor->status = $validated['status'];
        $vendor->save();

        $vendor->refresh();

        if ($validated['status'] === 'active' && $vendor->user) {
            User::where('id', $vendor->user_id)
            ->update(['role' => 'vendor']);
        }
        return back()->with('success', "De status van vendor {$vendor->shop_name} is bijgewerkt.");
    }
}
