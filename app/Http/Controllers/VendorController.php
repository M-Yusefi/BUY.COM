<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;

class VendorController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id(); 

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'bio' => 'required|string',
        ]);

        Vendor::create([
            'user_id' => $userId,
            'shop_name' => $request->shop_name,
            'bio' => $request->bio,
            'status' => 'pending'
        ]);

        return view('dashboard.index');
    }

    public function apply()
    {
        $userId = Auth::id();

        $vendorQuery = Vendor::where('user_id', $userId);
        
        if ($vendorQuery->exists()) {
            return back();
        }
        return view('vendors.apply');
    }

    public function vendorsOverview() 
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $vendors = Vendor::all();
            return view('admin.vendor', compact('vendors'));
        } else {
            return back()->with('error', 'You are not authorized to view this page.');
        }
    }

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
        return back();
    }
}
