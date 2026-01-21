<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    {{ $product->name }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- All Products Link --}}
                <a href="{{ route('products.index') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    All Products 
                </a>

                {{-- Category Link --}}
                <p 
                id="index_category"
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Category 
                </p>
            </div>
        </div>
    </x-slot>

	<div class="py-12">
        <div class="max-w-7xl mx-auto py-12 px-4">
            <div class="grid grid-cols-1 bg-white rounded-2xl shadow">
                
                <div>
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="w-full rounded-xl">
                    @else
                        <div class="bg-gray-100 h-64 flex items-center justify-center">No image</div>
                    @endif
                </div>

                <div class="p-8">
                    <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                    <p class="text-blue-600 font-semibold">{{ $product->category->name ?? 'No Category'}}</p>
                    <div class="mt-4 text-gray-600">
                        {{ $product->description }}
                    </div>
                    <p class="mt-6 text-2xl font-black">€{{ number_format($product->price, 2) }}</p>
                    
                    <button class="mt-8 bg-blue-600 text-white px-8 py-3 rounded-lg font-bold">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>