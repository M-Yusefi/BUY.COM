<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                    {{ __('Products Overview') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- Create Product Link --}}
                <a href="{{ route('products.create') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Create Products
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" style="table-layout: fixed;">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-16">Image</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-32">Name</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-24">Category</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider" style="width: 300px;">Description</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-20">Price</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-16">Stock</th>
                                    <th class="px-4 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-20">Status</th>
                                    <th colspan="2" class="px-2 py-2 sm:px-4 sm:py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider w-16 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="vendorIndexResult" class="bg-white divide-y divide-gray-200">
                                <tr><td colspan="8" class="px-2 sm:px-4 py-3 sm:py-4 text-gray-500 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>