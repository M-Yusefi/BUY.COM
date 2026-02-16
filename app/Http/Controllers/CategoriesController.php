<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CartItem;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories.categories');
    }

    public function createCatView()
    {
        return view('categories.createCat');
    }

    public function allCategories()
    {
        $allCat = Category::all();

        return response()->json([
            'categories' => $allCat,
        ]);
    } 

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer'
        ]);

        $parentId = ($validated['category_id'] ?? 0) == 0 ? null : $validated['category_id'];

        Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'parent_id' => $parentId
        ]);

        return back()->with('success', 'Categorie succesvol aangemaakt.');
    }

    public function filter(Request $request)
    {
        $query = $request->query('query');

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Products found.'
            ], 400);
        }   

        if ($query) {
            try {
                $products = Product::with('images', 'vendor', 'category')
                    ->where('category_id', 'LIKE', '%' . $query . '%')
                    ->get();

                $alreadyInCart = CartItem::where('user_id', Auth::id())
                                        ->pluck('product_id')
                                        ->toArray();

                $products->map(function ($product) use ($alreadyInCart) {
                    $product->is_in_cart = in_array($product->id, $alreadyInCart);
                    return $product;
                });

                return response()->json([
                    'status'   => 'success',
                    'products' => $products,
                    'query'    => $query
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        } 
    }
}
