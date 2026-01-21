<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    All Products
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
        <div id="products_index" class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">

        </div>
    </div>
</x-app-layout>
