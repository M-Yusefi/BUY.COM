<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;

class VendorController extends Controller
{   
    // Vendor dashboard view
    public function dashboard() 
    {
        $userId = Auth::id();
        
        // Get vendor by user_id
        $vendor = Vendor::where('user_id', $userId)->first();
        
        if (!$vendor) {
            return view([
                'products' => [],
                'error' => 'Vendor not found for this user'
            ]);
        }

        $products = Product::where('vendor_id', $vendor->id)->get();

        $totalProducts = count($products);

        return view('vendor.dashboard', [
            'totalProducts' => $totalProducts
        ]);
    }

    public function index()
    {
        return view('vendor.index');
    }

    // Vendor apply view
    public function apply()
    {
        $userId = Auth::id();
        $vendorQuery = Vendor::where('user_id', $userId);
        if ($vendorQuery->exists()) {
            return back();
        }
        return view('vendor.apply');
    }

    // Vendor apply function
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
}
