<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- Create Product Link --}}
                <a href="{{ route('vendor.index') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Products Overview
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="shadow-xl rounded-lg h-80 w-full sm:w-auto">
                <a href="{{ route('vendor.index') }}"
                class="w-full h-full flex flex-col justify-center items-center 
                        bg-blue-500 text-white rounded-lg 
                        hover:bg-white hover:text-blue-500 
                        transition duration-300 ease-in-out 
                        border-4 border-blue-500">

                    <div class="p-4 text-center">
                        <p class="text-3xl font-extrabold tracking-tight">
                            {{ __('Products') }}
                        </p>
                        <p class="text-2xl opacity-80 mt-2">
                            {{ $totalProducts }}
                        </p>
                    </div>
                </a>
            </div>    

            <div class="shadow-xl rounded-lg h-80 w-full sm:w-auto">
                <a  
                class="w-full h-full flex flex-col justify-center items-center 
                        bg-blue-500 text-white rounded-lg 
                        hover:bg-white hover:text-blue-500 
                        transition duration-300 ease-in-out 
                        border-4 border-blue-500">

                    <div class="p-4 text-center">
                        <p class="text-3xl font-extrabold tracking-tight">
                            {{ __('Orders') }}
                        </p>
                        <p class="text-sm opacity-80 mt-2">
                        </p>
                    </div>
                </a>
            </div>    
        </div>    
    </div>

</x-app-layout>