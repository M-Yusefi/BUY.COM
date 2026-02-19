<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    Your Cart 
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                {{-- All Products Link --}}
                <a href="{{ route('products.index') }}" 
                    class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                        All Products 
                </a>            
            </div>
        </div>
    </x-slot>

	<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($cartItems->isEmpty())
                    <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 p-6">
                        <p class="text-gray-600 text-3xl font-medium mb-6">No products to be found <i class="fa-solid fa-wind"></i></p>
                        <a href="{{ route('products.index') }}" class="text-xl underline text-blue-600 hover:text-blue-800">Aad product to your Cart <i class="fa-solid fa-cart-arrow-down text-xl"></i></a>
                    </div>
                @else
                    <div class="mb-8 p-4 bg-blue-600 rounded-xl flex items-center shadow-lg">
                        {{-- Item Count: Stays on the left --}}
                        <div class="flex-none">
                            <h1 class="font-bold text-xl text-white px-3">
                                <span class="text-blue-200">{{ count($cartItems) }}</span> Items in Cart
                            </h1>
                        </div>

                        {{-- Stepper Navigation: Centered in the remaining space --}}
                        <div class="flex-grow flex justify-center items-center text-m font-bold">
                            <div class="flex items-center">
                                {{-- Step 1: Cart --}}
                                <a href="{{ route('checkout.cart') }}" 
                                class="{{ request()->routeIs('checkout.cart') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Cart
                                </a>

                                <i class="fa-solid fa-arrow-right-long text-blue-300 px-2"></i>    
                                {{-- Step 2: Address --}}
                                <a href="{{ route('checkout.address') }}" 
                                class="{{ request()->routeIs('checkout.address') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Address
                                </a>

                                <i class="fa-solid fa-arrow-right-long text-blue-300 px-2"></i>    

                                {{-- Step 3: Overview --}}
                                <a href="{{ route('checkout.review') }}" 
                                class="{{ request()->routeIs('checkout.review') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Overview
                                </a>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('products.index') }}" 
                                class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                                hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                                    Add more product
                            </a>            
                        </div>

                        {{-- Invisible Spacer: This ensures the center is actually the center of the bar --}}
                        <div class="flex-none w-[150px] hidden md:block"></div>
                    </div>                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-4">
                        <div class="lg:col-span-2 space-y-4">
                            @foreach ($cartItems as $item)
                                @php $product = $item->product; @endphp
                                <div class="flex items-center bg-white rounded-xl border border-gray-200 shadow-sm hover:border-blue-300 transition-all gap-8">
                                    
                                    <div class="w-48 h-48 flex-shrink-0">
                                        <img src="{{ asset('storage/' . ($item->product->images->first())->image_path ?? 'placeholder.png') }}" 
                                            alt="{{ $product->name }}" 
                                            class="w-full h-full object-cover rounded-tl-xl rounded-bl-xl">
                                    </div>

                                    <div class="flex-grow">
                                        <h3 class="font-bold text-gray-800 text-lg">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500 italic">Sold by: {{ $product->vendor->shop_name ?? 'Unknown' }}</p>
                                        <div class="flex items-center mt-3 gap-3">
                                            <button onclick="updateQty({{ $item->id }}, -1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">-</button>
                                            <span class="font-semibold" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                                            <button onclick="updateQty({{ $item->id }}, 1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">+</button>
                                        </div>
                                    </div>

                                    <div class="text-right flex flex-col justify-between h-24 pr-8">
                                        <p class="font-extrabold text-blue-600 text-xl">€{{ number_format($product->price * $item->quantity, 2) }}</p>
                                        <p class="text-gray-600">€{{ number_format($product->price, 2) }}</p>
                                        <form action="{{ route('cart.delete',  $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-500 hover:scale-110 transition-transform">
                                                <i class="fa-solid fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="lg:col-span-1">
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-md sticky top-6">
                                <h2 class="text-xl font-bold mb-4 border-b pb-4 text-gray-800">Order Summary</h2>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Subtotal</span>
                                        <span class="total-price">€{{ number_format($total, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Shipping</span>
                                        <span class="text-green-600 font-medium">FREE</span>
                                    </div>
                                    <div class="flex justify-between text-xl font-black text-gray-900 border-t pt-4">
                                        <span>Total</span>
                                        <span class="total-price">€{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('checkout.address') }}">
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition-transform active:scale-95">
                                        Proceed the Order
                                    </button>
                                </a>
                                
                                <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-lock"></i> Secure Checkout
                                </p>
                            </div>
                        </div>
                    </div>               
                @endif
            </div>
        </div>
    </div>
</x-app-layout>