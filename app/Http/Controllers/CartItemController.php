<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Review;

class CartItemController extends Controller
{
    public function store(Request $request)
    {

        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Je moet eerst inloggen.'], 401);
        }

        $userId = Auth::id();
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Product not found.'
            ], 404);
        }

        $alreadyInCart = CartItem::where('user_id', $userId)
                                ->where('product_id', $product->id)
                                ->exists();

        if ($alreadyInCart) {
            return response()->json([
                'status' => 'info', 
                'message' => "{$product->name} is already in your cart."
            ]);
        }

        try {
            CartItem::create([
                'user_id'    => $userId,
                'product_id' => $product->id, 
                'quantity'   => 1
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => "{$product->name} added to cart!",
                'cartCount' => CartItem::where('user_id', $userId)->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'A server error occurred while adding the product.'
            ], 500);
        }    
    }
}
