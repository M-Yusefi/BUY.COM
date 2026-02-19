<x-app-layout>
	<x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">
                   My Orders 
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                {{-- All Products Link --}}
                <a href="{{ route('products.index') }}" 
                    class="flex items-center justify-center bg-white border-2 border-blue-100 rounded-xl px-5 py-2.5 shadow-sm text-gray-700 font-medium 
                    hover:bg-blue-50 hover:border-blue-300 focus:ring-4 focus:ring-blue-100 outline-none transition-all duration-300 w-full sm:w-auto whitespace-nowrap">
                        All Products 
                </a>            
            </div>
        </div>
    </x-slot>

	<div class="py-12">
        <div class="bg-white shadow-md rounded-lg max-w-7xl mx-auto ">
                <div class="flex items-center justify-between p-6 border-b border-blue-600">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900">My Orders</h1>
                        <p class="text-gray-500 mt-1">An overview of all your purchases at our store.</p>
                    </div>
                    @if (!$orders->isEmpty())
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold">
                            {{ count($orders) }} Orders
                        </span>
                    @endif
                </div>
                @if ($orders->isEmpty())
                    <div class="text-center py-20 px-6">
                        <div class="inline-flex items-center justify-center h-24 w-24 rounded-full bg-gray-50 mb-6 text-gray-300">
                            <i class="fa-solid fa-box-open text-4xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">No orders yet</h2>
                        <p class="text-gray-500 mb-8 max-w-sm mx-auto">You haven't placed any orders yet. Once you make a purchase, it will appear here.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Browse Products
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-b-lg border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th scope="col" class="px-4 py-4 text-left text-m font-semibold uppercase tracking-wider">
                                        Order 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-m font-semibold uppercase tracking-wider">
                                        Send To
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-m font-semibold uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-m font-semibold uppercase tracking-wider">
                                        Total Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-m font-semibold uppercase tracking-wider">
                                        items
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-m font-semibold uppercase tracking-wider">
                                        status
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach ($orders as $item) 
                                    <tr onclick="window.location='{{ route('order.show', $item->id) }}'" class="cursor-pointer hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            # {{ $item->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->address->full_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->address->address_line_1 }} -
                                            {{ $item->address->city }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            &euro; {{ number_format($item->total_price, 2, ".", ",") }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border 
                                                {{ $item->status === 'pending' ? 'bg-amber-100 text-amber-700 border-amber-200' : '' }}
                                                {{ $item->status === 'processing' ? 'bg-blue-100 text-blue-700 border-blue-200' : '' }}
                                                {{ $item->status === 'shipped' ? 'bg-purple-100 text-purple-700 border-purple-200' : '' }}
                                                {{ $item->status === 'completed' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : '' }}
                                                {{ $item->status === 'cancelled' ? 'bg-rose-100 text-rose-700 border-rose-200' : '' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
        </div>
    </div>
</x-app-layout>
