<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
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