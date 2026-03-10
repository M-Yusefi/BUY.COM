<x-app-layout>
   <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                  Dashboard 
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                {{-- All Products Link --}}
                <a href="{{ route('order.index') }}" 
                    class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                        Orders 
                </a>            
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            <div class="shadow-xl rounded-4xl h-80 w-full sm:w-auto">
                <a href="{{ route('order.index') }}" 
                class="w-full h-full flex flex-col justify-center items-center 
                        bg-blue-500 text-white rounded-2xl 
                        hover:bg-white hover:text-blue-500 
                        transition duration-300 ease-in-out 
                        border-4 border-blue-500">

                    <div class="p-4 text-center">
                        <p class="text-4xl font-extrabold tracking-tight">
                            {{ __('Orders') }}
                        </p>
                        <p class="text-4xl opacity-80 mt-6">
                            {{ count($orders) }}
                        </p>
                    </div>
                </a>
            </div>    

            <div class="shadow-xl rounded-lg h-80 w-full sm:w-auto">
                <div  
                class="w-full h-full flex flex-col justify-center items-center 
                        bg-blue-500 text-white rounded-2xl 
                        hover:bg-white hover:text-blue-500 
                        transition duration-300 ease-in-out 
                        border-4 border-blue-500">

                    <div class="p-4 text-center">
                        <p class="text-4xl font-extrabold tracking-tight">
                            {{ __('Total Purchased Items') }}
                        </p>
                        <p class="text-4xl opacity-80 mt-6">
                            {{ $totalItems }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="shadow-xl rounded-lg h-80 w-full sm:w-auto">
                <div
                class="w-full h-full flex flex-col justify-center items-center 
                        bg-blue-500 text-white rounded-2xl 
                        hover:bg-white hover:text-blue-500 
                        transition duration-300 ease-in-out 
                        border-4 border-blue-500">

                    <div class="p-4 text-center">
                        <p class="text-4xl font-extrabold tracking-tight">
                            {{ __('Total Spent') }}
                        </p>
                        <p class="text-4xl opacity-80 mt-6">
                            {{ $totalSpent }}
                        </p>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</x-app-layout>
