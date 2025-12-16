<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex items-center space-x-6">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight py-2 px-3">
                    {{ __('Create Product') }}
                </h2>
            </div>
        </div>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-blue-100">
                    <h1 class="text-3xl font-extrabold mb-4 text-gray-900">List a New Product: Maximize Your Visibility</h1>
                    
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">
                        This is your chance to create a new listing! Accurately filling in the fields below is the key to maximizing discoverability and increasing conversion within the <span class="font-bold text-blue-600">BUY.COM</span> marketplace.
                    </p>

                    <div class="space-y-4 mb-4">
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-blue-400 p-4 py-2 bg-blue-50">
                            ✅ <span class="text-lg font-semibold">Product Name & Description:</span>  Use clear, keyword-rich titles and detailed descriptions. Think about what the customer would type into the search bar.
                        </p>
                        
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-green-400 p-4 py-2 bg-green-50">
                            🏷️ <span class="text-lg font-semibold">Category Selection:</span> Choose the most specific category. Accurate categorization ensures your product appears in the correct filters and navigation structures.
                        </p>

                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-purple-400 p-4 py-2 bg-purple-50">
                            € <span class="text-lg font-semibold">Price & Stock:</span> Ensure competitive pricing and keep your inventory count up-to-date. Stock must be a positive number for the product to be sellable.
                        </p>

                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-yellow-500 p-4 py-2 bg-yellow-50">
                            🖼️ <span class="text-lg font-semibold">Product Images:</span>  High-quality images are critical for conversion. Upload clear, well-lit photos showing your product from multiple angles. This builds customer trust and reduces returns.
                        </p>
                    </div>

                    {{-- Tip 4: Status --}}
                    <p class="text-gray-600 text-base leading-relaxed mt-auto border-t pt-4">
                        <span class="text-lg font-semibold">Status Management:</span> Set to <span class="text-yellow-500 font-semibold ">Draft</span> if you want to save the product and edit it later.
                        Choose <span class="text-green-500 font-semibold">Live</span> to immediately publish it on the website and make it available for customer purchase. You can always change the status later.
                    </p>
                </div>
                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-3">Create Product</h2>
                    
                    <form action="{{ route('products.store') }}" method="POST" class="flex flex-col gap-6 flex-1">
                        @csrf 

                        <div class="flex flex-col">
                            <label for="name" class="mb-2 font-medium text-gray-700">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" 
                                value="{{ old('name') }}" {{-- ⭐ Toon de oude waarde bij validatiefout --}}
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('name') border-red-500 ring-red-500 @enderror" 
                                placeholder="HP laptop">
                            @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="description" class="mb-2 font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full resize-none
                                        @error('description') border-red-500 ring-red-500 @enderror"
                                placeholder="Describe the category.">{{ old('description') }}</textarea> {{-- ⭐ Toon de oude waarde --}}
                            @error('description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="category_id" class="mb-2 font-medium text-gray-700">Category</label>
                            {{-- Je moet de opties hier op de Blade-manier vullen (niet met JS) of de JavaScript aanvullen om old() te ondersteunen --}}
                            <select name="category_id" id="category_id"
                                    class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('category_id') border-red-500 ring-red-500 @enderror">
                                {{-- OPTIES WORDEN HIER LATER INGEVOEGD --}}
                            </select>
                            @error('category_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="price" class="mb-2 font-medium text-gray-700">Price <span class="text-red-500">*</span></label>
                            <input type="number" id="price" name="price"
                                value="{{ old('price') }}"
                                step="0.01" {{-- ⭐ Zorgt voor correcte decimalen --}}
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('price') border-red-500 ring-red-500 @enderror" 
                                placeholder="899.00">
                            @error('price') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col"> {{-- ⭐ Correctie: flex flex-col ⭐ --}}
                            <label for="stock" class="mb-2 font-medium text-gray-700">Stock <span class="text-red-500">*</span></label>
                            <input type="number" id="stock" name="stock"
                                value="{{ old('stock') }}"
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('stock') border-red-500 ring-red-500 @enderror" 
                                placeholder="50">
                            @error('stock') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col"> {{-- ⭐ Correctie: flex flex-col ⭐ --}}
                            <label for="status" class="mb-2 font-medium text-gray-700">Status </label>
                            <select name="status" id="status"
                                    class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                                
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="live" {{ old('status') == 'live' ? 'selected' : '' }}>Live</option> {{-- ⭐ Correctie: value="live" ⭐ --}}

                            </select>
                            @error('status') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="mt-auto pt-4">
                            <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold text-lg hover:bg-blue-700 transition duration-300 transform hover:scale-[1.01] w-full shadow-lg shadow-blue-500/50">
                                Create
                            </button>
                        </div>
                    </form>                
                </div>
            </div>        
        </div>
    </div>
</x-app-layout>
