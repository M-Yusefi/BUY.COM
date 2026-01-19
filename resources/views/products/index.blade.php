<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Products Overview') }}
		</h2>
	</x-slot>

	<div class="py-12">
        <div id="products_index" class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

        </div>
    </div>
</x-app-layout>
