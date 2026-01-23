<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="flex items-center space-x-6">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight py-2 px-3">
                    {{ __('Create Categories') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-blue-100">
                    <h1 class="text-3xl font-extrabold mb-4 text-gray-800">Add New Product Category</h1>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        Manage the store's taxonomy and structure. Categories are the foundational element used by vendors and customers to organize, discover, and filter products efficiently.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed border-l-4 border-blue-400 pl-4 py-2 bg-blue-50">
                        Once a category is established, vendors on <span class="font-bold text-blue-600">BUY.COM</span> will be able to **select this category** when listing new products. This is vital for site navigation.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed mt-auto">
                        Please choose a clear and unique name. Remember that categories cannot be easily deleted if they are currently linked to active products.
                    </p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-3">Create Categories</h2>
                    
                    <form action="{{ route('categories.store') }}" method="POST" class="flex flex-col gap-6 flex-1">
                        @csrf 

                        <div class="flex flex-col">
                            <label for="categoryName" class="mb-2 font-medium text-gray-700">Category Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                    @error('name') border-red-500 ring-red-500 @enderror" 
                                placeholder="Electronics">
                        </div>

                        <div class="flex flex-col">
                            <label for="description" class="mb-2 font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full resize-none
                                @error('description') border-red-500 ring-red-500 @enderror"
                                placeholder="Describe the category."></textarea>
                        </div>

                        <div class="flex flex-col">
                            <label for="category_id" class="mb-2 font-medium text-gray-700">Parent Category (<span class="text-blue-500">Optional</span>)</label>
                            <select name="category_id" class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                                <option value="0" class="font-bold text-blue-700">Main Catagory</option>
                                <p id="category_id"></p>
                            </select>
                        </div>

                        <div class="mt-auto pt-4">
                            <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold text-lg
                                    hover:bg-blue-700 transition duration-300 transform hover:scale-[1.01] w-full shadow-lg shadow-blue-500/50">
                                Send Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</x-app-layout>

