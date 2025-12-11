<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;

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
            'parent_id' => 'nullable|integer'
        ]);

        $parentId = ($validated['parent_id'] == 0) ? null : $validated['parent_id'];

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $parentId
        ]);

        return back()->with('success', 'Categorie succesvol aangemaakt.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
