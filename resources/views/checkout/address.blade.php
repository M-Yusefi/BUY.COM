<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    Your Addresses 
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
            <div class="bg-white overflow-hidden shadow-md rounded-2xl">
                    <div class="mb-8 p-6 bg-blue-600 flex items-center shadow-lg">
                        <div class="flex-none">
                            <h1 class="font-bold text-xl text-white px-3">
                                Select Your Address
                            </h1>
                        </div>

                        <div class="flex-grow flex justify-center items-center text-m font-bold">
                            <div class="flex items-center">
                                <a href="{{ route('checkout.cart') }}" 
                                class="{{ request()->routeIs('checkout.cart') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Cart
                                </a>

                                <i class="fa-solid fa-arrow-right-long text-blue-300 px-2"></i>    
                                <a href="{{ route('checkout.address') }}" 
                                class="{{ request()->routeIs('checkout.address') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Address
                                </a>

                                <i class="fa-solid fa-arrow-right-long text-blue-300 px-2"></i>    

                                <a href="{{ route('checkout.review') }}" 
                                class="{{ request()->routeIs('checkout.review') ? 'text-white' : 'text-blue-300 hover:text-white' }} transition">
                                    Overview
                                </a>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('address.create') }}" 
                                class="font-bold text-xl text-white px-3 underline">
                                    Or Create Cne
                            </a>            
                        </div>

                        <div class="flex-none w-[150px] hidden md:block"></div>
                    </div>                    

                <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-8 p-4">
                    <div class="bg-white shadow-xl rounded-2xl flex flex-col h-full border border-blue-100">
                        <h1 class="bg-blue-600 rounded-t-2xl text-white font-extrabold text-2xl shadow-lg shadow-blue-500/50 p-4 mb-4"> 
                            Your Addresses
                        </h1>

                        <div class="h-full p-4 flex flex-col">
                            @if ($addresses->isEmpty())
                                <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 p-6">
                                    <p class="text-gray-600 text-lg font-medium">You have no registered addresses yet.</p>
                                    <a href="{{ route('address.create') }}" class="text-blue-600 hover:underline mt-2 inline-block font-semibold">
                                        + Create a new address
                                    </a>
                                </div>
                            @else
                                <form action="{{ route('checkout.setAddress') }}" method="POST" class="flex flex-col flex-grow">
                                    @csrf
                                    
                                    <div class="grid grid-cols-1 gap-4 flex-grow overflow-y-auto pr-2">
                                        @foreach ($addresses as $ad)
                                            <label class="relative flex border rounded-xl p-4 cursor-pointer hover:bg-blue-50 transition border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                                <input type="radio" name="selected_address" value="{{ $ad->id }}" class="mt-1 h-4 w-4 text-blue-600" {{ $loop->first ? 'checked' : '' }}>
                                                <div class="ml-4">
                                                    <span class="block text-sm font-bold text-gray-900">{{ $ad->full_name }}</span>
                                                    <span class="block text-sm text-gray-600">{{ $ad->address_line_1 }}</span>
                                                    <span class="block text-sm text-gray-600">{{ $ad->postal_code }}, {{ $ad->city }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-md hover:bg-blue-700 transition">
                                            Use Selected Address
                                        </button>
                                    </div>
                                </form>

                                <hr class="border-gray-100 mt-4">  
                                
                                <div class="mt-4">
                                    <a href="{{ route('address.create') }}">
                                        <button type="button" class="w-full bg-gray-100 text-gray-700 font-bold py-3 rounded-xl shadow-sm hover:bg-gray-200 transition border border-gray-300">
                                            + Create a new address
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>                
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
    </div>
</x-app-layout>