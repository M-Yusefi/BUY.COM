<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                    {{ __('Update') }}
                    <span class="text-blue-500 pl-2">{{ $product['name'] }}</span>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-blue-100">
                    <h1 class="text-3xl font-extrabold mb-4 text-gray-900">Update Product: Refine Your Listing</h1>
                    
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">
                        Keep your product information accurate and up-to-date. Regularly refining your listing helps maintain high visibility and builds trust with your customers on <span class="font-bold text-blue-600">BUY.COM</span>.
                    </p>

                    <div class="space-y-4 mb-4">
                        {{-- Tip 1: Name and Description --}}
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-blue-400 p-4 py-2 bg-blue-50">
                            ✅ <span class="text-lg font-semibold">Content Optimization:</span> Review your title and description. Ensure they still reflect the product accurately and include relevant keywords to stay on top of search results.
                        </p>
                        
                        {{-- Tip 2: Category --}}
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-green-400 p-4 py-2 bg-green-50">
                            🏷️ <span class="text-lg font-semibold">Category Check:</span> Make sure your product is still in the most relevant category. Proper placement is essential for correct filtering and customer discovery.
                        </p>

                        {{-- Tip 3: Price and Stock --}}
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-purple-400 p-4 py-2 bg-purple-50">
                            € <span class="text-lg font-semibold">Pricing & Inventory:</span> Adjust your price based on market trends and update your stock levels immediately to prevent overselling and maintain a high vendor rating.
                        </p>

                        {{-- Tip 4: Images --}}
                        <p class="text-gray-600 text-base leading-relaxed border-l-4 border-yellow-500 p-4 py-2 bg-yellow-50">
                            🖼️ <span class="text-lg font-semibold">Visual Refresh:</span> Consider updating your images if you have better quality photos. Clear, multi-angle shots are the most effective way to drive conversions.
                        </p>
                    </div>

                    {{-- Status Management --}}
                    <p class="text-gray-600 text-base leading-relaxed mt-auto border-t pt-4">
                        <span class="text-lg font-semibold">Visibility Control:</span> You can toggle the status at any time. Switching to <span class="text-yellow-500 font-semibold ">Draft</span> will temporarily hide the product from the storefront without losing your data. Set it to <span class="text-green-500 font-semibold">Live</span> to keep it available for purchase.
                    </p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-3">Create Product</h2>
                    
                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="flex flex-col gap-6 flex-1">
                        @csrf 
                        @method('PUT')
                        <div class="flex flex-col">
                            <label for="name" class="mb-2 font-medium text-gray-700">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" 
                                value="{{ old('name', $product->name) }}"
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('name') border-red-500 ring-red-500 @enderror" 
                                placeholder="HP laptop">
                            @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="images" class="mb-2 font-medium text-gray-700">Product Image <span class="text-red-500">*</span></label>
                            <input type="file" id="images" name="images[]" multiple 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('img') border-red-500 ring-red-500 @enderror" 
                                accept="image/*"
                                placeholder="ProductImage.jpg">
                            @error('img') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="description" class="mb-2 font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full resize-none
                                        @error('description') border-red-500 ring-red-500 @enderror"
                                placeholder="Describe the category.">{{ old('description', $product->description) }}</textarea> 
                            @error('description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="category_id" class="mb-2 font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                    class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('category_id') border-red-500 ring-red-500 @enderror">
                            </select>
                            @error('category_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="price" class="mb-2 font-medium text-gray-700">Price <span class="text-red-500">*</span></label>
                            <input type="number" id="price" name="price"
                                value="{{ old('price', $product->price) }}"
                                step="0.01" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('price') border-red-500 ring-red-500 @enderror" 
                                placeholder="899.00">
                            @error('price') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col"> 
                            <label for="stock" class="mb-2 font-medium text-gray-700">Stock <span class="text-red-500">*</span></label>
                            <input type="number" id="stock" name="stock"
                                value="{{ old('stock', $product->stock) }}"
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                        @error('stock') border-red-500 ring-red-500 @enderror" 
                                placeholder="50">
                            @error('stock') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="status" class="mb-2 font-medium text-gray-700">Status </label>
                            <select name="status" id="status"
                                    class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                                
                                <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="live" {{ old('status', $product->status) == 'live' ? 'selected' : '' }}>Live</option> 

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