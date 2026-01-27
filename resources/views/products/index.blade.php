<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 id="product_index_header" class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    All Products
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- All Products Link --}}
                <a href="{{ route('products.index') }}" 
                    class="appearance-none bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none w-full transition-all duration-300 cursor-pointer">
                        All Products 
                </a>

                {{-- Category Link --}}
                <select name="category_id" id="index_filter_category" class="appearance-none bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none w-64 transition-all duration-300 cursor-pointer
                    @error('category_id') border-red-500 ring-red-100 @enderror">
                    
                    <option value="" disabled selected >Categories</option>
                    <p id="category_id"></p>
                </select>
            </div>
        </div>
    </x-slot>

	<div class="py-12">
        <div id="products_index" class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
            <!-- Hier komt overzicht van alle producten vanuit JS -->
        </div>
    </div>
</x-app-layout>
