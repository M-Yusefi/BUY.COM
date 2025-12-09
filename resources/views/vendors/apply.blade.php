<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your shop starts here — Apply now') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-blue-100">
                    <h1 class="text-3xl font-extrabold mb-4 text-gray-800">Apply Now to Sell Your Products</h1>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        By applying, you can start your own shop on <span class="font-bold text-blue-600">BUY.COM</span>, manage your products, and reach more customers.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed border-l-4 border-blue-400 pl-4 py-2 bg-blue-50">
                        After your application is **approved by the admin** (status: *Pending* $\to$ *Live*), you can start adding products and receive orders directly.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed mt-auto">
                        Enjoy full control over your shop, track your sales, and grow your business with our easy-to-use platform. Apply now and take the first step towards reaching thousands of customers!
                    </p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-3">Vendor Application Form</h2>
                    
                    <form action="{{ route('vendors.store') }}" method="POST" class="flex flex-col gap-6 flex-1">
                        @csrf 

                        <div class="flex flex-col">
                            <label for="shopName" class="mb-2 font-medium text-gray-700">Shop Name <span class="text-red-500">*</span></label>
                            <input type="text" id="shopName" name="shop_name" 
                                value="{{ old('shop_name') }}"
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full 
                                @error('shop_name') border-red-500 ring-red-500 @enderror" 
                                placeholder="e.g. Piliphs Electronics">
                            @error('shop_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="bio" class="mb-2 font-medium text-gray-700">Bio <span class="text-red-500">*</span></label>
                            <textarea name="bio" id="bio" rows="4" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full resize-none
                                @error('bio') border-red-500 ring-red-500 @enderror"
                                placeholder="Describe your shop and products (e.g. High-quality electronics and fast delivery).">{{ old('bio') }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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