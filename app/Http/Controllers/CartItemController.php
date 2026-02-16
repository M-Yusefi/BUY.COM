<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = CartItem::where('user_id', $userId)
                            ->with('product.vendor','product.category','product.images')
                            ->get();

        $total = $cartItems->sum(function($item) {
            return ($item->product?->price ?? 0) * $item->quantity;
        });


        return view('checkout.index', compact('cartItems', 'total'));
    }    


    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error', 
                'message' => 'You have to login first in order to add this product in to your cart.'
            ], 401);
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


    public function update(Request $request, CartItem $cartItem)
    {
        $user = Auth::user();

        if ($cartItem->user_id !== $user->id) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }     

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $newTotal = 0;
        foreach (CartItem::where('user_id', $user->id)->with('product')->get() as $item) {
            $newTotal+= $item->product->price * $item->quantity;
        }

        return response()->json([
            'status' => 'success',
            'newTotal' => number_format($newTotal, 2, '.', ',')
        ]);
    }

    public function delete(Product $product)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();
        
        if ($cartItem) {
            $cartItem->delete();
            return back()->with('success', "{$product->name} removed from cart.");
        }

        return back()->with('error', 'Item not found in your cart.');
    }
}
