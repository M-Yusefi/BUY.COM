<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                  Order Number # {{ $order->id }} 
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
    <div class="bg-white shadow-md rounded-lg max-w-7xl mx-auto ">
        {{-- Check if order exists --}}
        @if ($order)
            <div class="flex items-center justify-between p-6 border-b border-blue-600">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900">My Order</h1>
                    <p class="text-gray-500 mt-1">An overview of your order.</p>
                </div>
                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold">
                    Order number # {{ $order->id }}
                </span>
            </div>

            <div class="mb-4 p-2 bg-blue-600">
                <h1 class="font-bold text-2xl text-white p-3">
                    {{-- Count the items relationship --}}
                    <span class="text-blue-300">{{ $order->items->count() }}</span> Purchased Items
                </h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-4">
                {{-- Left Side: Items List --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($order->items as $item)
                        @php $product = $item->product; @endphp
                        <div class="flex items-center bg-white rounded-xl border border-gray-200 shadow-md hover:border-blue-300 transition-all gap-8">
                            
                            <div class="w-48 h-48 flex-shrink-0">
                                <img src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'placeholder.png')) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover rounded-tl-xl rounded-bl-xl">
                            </div>

                            <div class="flex-grow">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 italic">Sold by: {{ $product->vendor->shop_name ?? 'Unknown' }}</p>
                                <div class="flex items-center mt-3 gap-3">
                                    <span class="font-semibold">Quantity: {{ $item->quantity }}</span>
                                </div>
                            </div>

                            <div class="text-right flex flex-col justify-between h-32 pr-8 py-4">
                                <p class="font-extrabold text-blue-600 text-xl">€{{ number_format($item->price * $item->quantity, 2) }}</p>
                                <p class="text-gray-600">€{{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Right Side: Summary and Address --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-md sticky top-6">
                        <h2 class="text-xl font-bold mb-4 border-b pb-4 text-gray-800">Order Summary</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>€{{ number_format($order->total_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">FREE</span>
                            </div>
                            <div class="flex justify-between text-xl font-black text-gray-900 border-t pt-4">
                                <span>Total</span>
                                <span>€{{ number_format($order->total_price, 2) }}</span>
                            </div>

                            <p class="p-3 rounded-full text-m font-bold border text-center w-96 
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700 border-blue-200' : '' }}
                                {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-700 border-purple-200' : '' }}
                                {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700 border-rose-200' : '' }}">
                                {{ ucfirst($order->status) }}
                            </p>

                        </div>
                    </div>

                    {{-- Address Card --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-md">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-truck-fast mr-2"></i> Shipping Address
                        </h2>
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-sm">
                            <p class="font-bold text-gray-900 text-base">{{ $order->address->full_name }}</p>
                            <p class="text-gray-600">{{ $order->address->address_line_1 }}</p>
                            <p class="text-gray-600">{{ $order->address->postal_code }} {{ $order->address->city }}</p>
                            <p class="text-gray-500 font-medium uppercase text-xs tracking-widest mt-2">{{ $order->address->country }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-gray-800">Order not found.</h2>
                <a href="{{ route('orders.index') }}" class="text-blue-600 underline">Back to my orders</a>
            </div>
        @endif
    </div>
</div></x-app-layout>
