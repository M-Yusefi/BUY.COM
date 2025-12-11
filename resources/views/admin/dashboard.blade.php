<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- Vendor Link --}}
                <a href="{{ route('admin.vendor') }}" 
                class="text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Vendors
                </a>
                
                {{-- Categorie Link --}}
                <a href="{{ route('categories.categories') }}" 
                class="text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Categories
                </a>

            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Admin dash") }}

                    <div id="resultsContainer" >

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
