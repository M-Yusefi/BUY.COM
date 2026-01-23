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
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Review;

class ProductsController extends Controller
{
    // Haalt alle producten op en rendert deze in de index-view.
    public function index()
    {
        return view('products.index');
    }

    public function index_data(Request $request)
    {
        $products = Product::with('vendor', 'category', 'images')->get();

        return response()->json([
            'products' => $products
        ]);
    }
    //</>//
    

    //  Haalt de details van een specifiek product op voor weergave in de show-view.
    public function show(Product $product)
    {
        $product->load(['vendor', 'category', 'images']);

        return view('products.show', compact('product'));
    }
    //</>//


    // Haalt vendor-specifieke producten op en retourneert deze als JSON voor de frontend.
    public function data(Request $request)
    {
        $userId = Auth::id();
        
        $vendor = Vendor::where('user_id', $userId)->first();
        
        if (!$vendor) {
            return response()->json([
                'products' => [],
                'error'    => 'Vendor not found for this user'
            ]);
        }

        $products = Product::where('vendor_id', $vendor->id)->with(['category', 'images'])->get();

        return response()->json([
            'products' => $products
        ]);
    }
    //</>//


    // Navigeert naar de create-pagina en verwerkt het formulier om de data op te slaan in de database.
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name'        => 'required|string|max:255',
                'images'      => 'required',
                'images.*'    => 'image|mimes:jpeg,jpg,png,webp|max:2048',
                'description' => 'nullable|string',
                'price'       => 'required|numeric',
                'stock'       => 'required|integer|min:0',
                'status'      => 'required|in:draft,live'
            ]);

            $vendor = Vendor::where('user_id', Auth::id())->firstOrFail(); 

            $product = Product::create(array_merge(
                collect($validated)->except('images')->toArray(), 
                ['vendor_id' => $vendor->id,]
            ));

            if ($request->hasFile('images')) {

                $currentImagesCount = 0;

                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'alt_text'   => $product->name,
                        'is_main'    => ($currentImagesCount === 0 && $index === 0),
                        'order'      => $currentImagesCount + $index
                    ]);
                }
            }

            return back()->with('success', "The product ({$validated['name']}) is successfully created");
        } catch (\Exception $e) {
            return back()->with('error', "Error creating product: {$e->getMessage()}");
        }
    }
    //</>//


    // Navigeert naar de edit-pagina en slaat de gewijzigde gegevens op in de database.
    public function edit(Product $product)
    {
        return view('products.update', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name'        => 'required|string|max:255',
                'images'      => 'nullable',
                'images.*'    => 'image|mimes:jpeg,jpg,png,webp|max:2048',
                'description' => 'nullable|string',
                'price'       => 'required|numeric',
                'stock'       => 'required|integer|min:0',
                'status'      => 'required|in:draft,live'
            ]);

            $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

            if ($product->vendor_id !== $vendor->id) {
                abort(403, 'Unauthorized action.');
            }

            $product->update(collect($validated)->except('images')->toArray());

            if ($request->hasFile('images')) {

                $currentImagesCount = $product->images()->count();

                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'alt_text'   => $product->name,
                        'is_main'    => ($currentImagesCount === 0 && $index === 0),
                        'order'      => $currentImagesCount + $index
                    ]);
                }
            }

            return back()->with('success', "The product ({$product->name}) is successfully updated");
        } catch (\Exception $e) {
            return back()->with('error', "Error updating product: {$e->getMessage()}");
        }
    }
    //</>//

    // Zoekt producten op basis van de zoekterm en stuurt de resultaten als JSON naar de frontend
    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            try {
                $products = Product::with('images') 
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->get();

                return response()->json([
                    'status' => 'success',
                    'products' => $products
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
    }
    //</>//

    // Verwijdert het opgegeven product uit de database.
    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $product->images()->delete();
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
    //</>//
}
