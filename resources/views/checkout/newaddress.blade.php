<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    Create New Address 
                </h2>
            </div>

            <div class="flex flex-row gap-4">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('products.index') }}" 
                        class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                        hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                            All Products 
                    </a>            
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('checkout.cart') }}" 
                        class="flex items-center justify-centerbg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                        hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-68 sm:w-auto whitespace-nowrap">
                            <i class="fa-solid fa-arrow-left mr-2"></i>                
                            Cart 
                    </a>            
                </div>
            </div>
        </div>
    </x-slot>

	<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white shadow-xl rounded-2xl flex flex-col h-full border border-blue-100">
                    <h1 class="bg-blue-600 rounded-t-2xl text-white font-extrabold text-2xl shadow-lg shadow-blue-500/50 p-4 mb-4"> 
                        New Address
                    </h1>
                    <form action="{{ route('address.store') }}" method="POST" class="flex flex-col gap-4 p-4">
                        @csrf

                        <div class="flex flex-col">
                            <label for="full_name" class="mb-2 font-medium text-lg text-gray-700">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                class="border rounded-lg capitalize px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full @error('full_name') border-red-500 bg-red-100 @enderror" 
                                placeholder="e.g. John Doe"
                                autocomplete="name">
                            @error('full_name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="address_line_1" class="mb-2 font-medium text-lg text-gray-700">Address <span class="text-red-500">*</span></label>
                            <input type="text" id="address_line_1" name="address_line_1" value="{{ old('address_line_1') }}"
                                class="border rounded-lg capitalize px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full @error('address_line_1') border-red-500 bg-red-100 @enderror" 
                                placeholder="Streetname 123"
                                autocomplete="street-address">
                            @error('address_line_1') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="city" class="mb-2 font-medium text-lg text-gray-700">City <span class="text-red-500">*</span></label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}"
                                    class="border rounded-lg capitalize px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full @error('city') border-red-500 bg-red-100 @enderror" 
                                    placeholder="Zwolle">
                                @error('city') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="postal_code" class="mb-2 font-medium text-lg text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}"
                                    class="border rounded-lg uppercase px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full @error('postal_code') border-red-500 bg-red-100 @enderror" 
                                    placeholder="1234 AB">
                                @error('postal_code') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label for="country" class="mb-2 font-medium text-lg text-gray-700">Country <span class="text-red-500">*</span></label>
                            <select name="country" id="country" 
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full @error('country') border-red-500 bg-red-100 @enderror">
                                <option value="" disabled>Select Your Country</option>
                                
                                <option value="Netherlands">
                                    Netherlands
                                </option>
                                
                                <option value="Belgium">
                                    Belgium
                                </option>
                                
                                <option value="Germany">
                                    Germany
                                </option>
                                
                                <option value="France">
                                    France
                                </option>
                            </select>
                            @error('country') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="phone_number" class="mb-2 font-medium text-lg text-gray-700">Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                class="border rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 w-full" 
                                placeholder="+31 6 12345678">
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold text-lg hover:bg-blue-700 transition duration-300 w-full shadow-lg shadow-blue-500/50">
                                Save Address & Continue
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-8 flex flex-col h-full border border-blue-100">
                    <h1 class="bg-blue-600 rounded-t-2xl text-white font-extrabold text-2xl shadow-lg shadow-blue-500/50 p-4 -mt-8 -mx-8 mb-6"> 
                        Helpful Information
                    </h1>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-lg text-gray-800 font-bold flex items-center mb-3">
                                <span class="bg-blue-100 text-blue-600 rounded-full h-8 w-8 flex items-center justify-center mr-3 text-sm">1</span>
                                Filling in your address
                            </h3>
                            <ul class="text-gray-600 text-m space-y-3 ml-4 list-disc">
                                <li><strong>Double-check your zip code:</strong> A small typo can cause your package to be sent to the wrong city.</li>
                                <li><strong>House number additions:</strong> Don't forget to add your apartment or suite number (e.g., 15-B) so the courier can find you.</li>
                                <li><strong>Phone number:</strong> We only use this if the delivery driver can't find your front door or if there's a problem with the delivery.</li>
                            </ul>
                        </div>

                        <hr class="border-gray-100">

                        <div>
                            <h3 class="text-lg text-gray-800 font-bold flex items-center mb-3">
                                <span class="bg-green-100 text-green-600 rounded-full h-8 w-8 flex items-center justify-center mr-3 text-sm">2</span>
                                Your privacy is safe
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04c0 4.833 1.273 9.41 3.515 13.391a12.142 12.142 0 0010.206 0c2.242-3.982 3.515-8.378 3.515-13.391z" />
                                    </svg>
                                    <p class="text-gray-600 text-m">
                                        <strong>No spam:</strong> We will never use your address for marketing purposes or sell your data to third parties.
                                    </p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <p class="text-gray-600 text-m">
                                        <strong>Encrypted storage:</strong> Your information is stored on secure, encrypted servers following GDPR standards.
                                    </p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-600 text-m">
                                        <strong>Shipping only:</strong> We only share your address with our trusted logistics partners (like PostNL, DHL, or UPS) to deliver your order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-8 border-t border-gray-100 flex items-center justify-center space-x-2">
                        <span class="text-xs text-gray-400 font-bold tracking-widest uppercase">100% Secure Checkout</span>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</x-app-layout>