<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index() {
        $addresses = Auth::user()->addresses;
        return view('checkout.address', compact('addresses')); 
    }

    public function create() {
        return view('checkout.newaddress');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'phone_number' => 'nullable|string',
        ]);
        
        $validated['is_default'] = Auth::user()->addresses()->count() === 0;

        Auth::user()->addresses()->create($validated);

        return redirect()->route('checkout.address');
    }

    public function setAddress(Request $request)
    {
        $request->validate([
            'selected_address' => 'required|exists:user_addresses,id'
        ]);

        session(['selected_address_id' => $request->selected_address]);
        
        return redirect()->route('checkout.review');
    }
}
