<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    Success 
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
            <div class="bg-white shadow-md rounded-2xl max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center p-8">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-blue-600 mb-8">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Thanks for your order!</h1>
                <p class="text-lg text-gray-600 mb-8">Order #{{ $order->id }} is successfully placed and being processed.</p>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden text-left">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="font-bold text-gray-800">Order Summary</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $item->quantity }}x {{ $item->product->name }}</span>
                                <span class="font-medium text-gray-900">€{{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                        
                        <hr class="border-gray-100">
                        
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-blue-600">€{{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between p-4 bg-blue-50 border-t border-blue-100">
                        <p class="text-sm text-blue-800">
                            <strong>Shipping to:</strong> {{ $order->address->full_name }}, {{ $order->address->address_line_1 }}, {{ $order->address->city }}
                        </p>
                        
                        <a href="{{ route('order.index') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-700 transition">
                            Order History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
