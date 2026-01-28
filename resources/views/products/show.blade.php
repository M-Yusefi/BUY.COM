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
                    class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                        All Products 
                </a>            
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