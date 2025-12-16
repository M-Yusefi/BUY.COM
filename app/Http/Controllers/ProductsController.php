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

class ProductsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $products = Product::where('vendor_id', $userId)->get();

        return response()->json([
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:draft,live'
        ]);

        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail(); 

        Product::create(array_merge($validated, [
            'vendor_id' => $vendor->id,
        ]));
        
        return back()->with('success', "The product ({$validated['name']}) is successfully created");
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
