<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex items-center space-x-6">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                    {{ __('Categories') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                <a href="{{ route('categories.createCat') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Create Categories
                </a>
                
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="index_categories">
                    
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>
</x-app-layout>

