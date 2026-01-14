<x-app-layout>
    <x-slot name="header"> 
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                    {{ __('vendor Overview') }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                
                {{-- Vendor Link --}}
                <a href="{{ route('admin.vendor') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Vendors
                </a>
                
                {{-- Categorie Link --}}
                <a href="{{ route('categories.categories') }}" 
                class="text-m font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out py-2 px-3 rounded-lg hover:bg-gray-50">
                    Categories
                </a>

            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900  bg-white shadow-lg rounded-xl">
                    @if ($vendors->isEmpty())
                        <div class="text-center py-10 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 p-6">
                            <p class="text-gray-600 text-lg font-medium">No Vendors to be found :\</p>
                        </div>
                    @else
                        <div class="mb-4 pb-2 border-b border-blue-600">
                            <h1 class="font-bold text-2xl text-gray-800 p-3">
                                <span class="text-blue-600">{{ count($vendors) }}</span> Registered Vendors
                            </h1>
                        </div>

                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                            Shop Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                            Bio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                            Created at
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach ($vendors as $vendor) 
                                        <tr 
                                            class=" @if ($vendor['status'] === 'pending')
                                                        {{-- Grijs/Wit voor Pending --}}
                                                        {{ $loop->iteration % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} 
                                                        hover:bg-blue-50/50 transition duration-150

                                                    @elseif ($vendor['status'] === 'active')
                                                        {{-- Groen voor Active --}}
                                                        {{ $loop->iteration % 2 == 0 ? 'bg-green-100' : 'bg-green-200' }} 
                                                        hover:bg-green-100/70 transition duration-150

                                                    @elseif ($vendor['status'] === 'blocked') 
                                                        {{-- Rood voor Blocked --}}
                                                        {{ $loop->iteration % 2 == 0 ? 'bg-red-100' : 'bg-red-200' }} 
                                                        hover:bg-red-100/70 transition duration-150

                                                    @else
                                                        {{-- Fallback voor onbekende status --}}
                                                        {{ $loop->iteration % 2 == 0 ? 'bg-yellow-100' : 'bg-yellow-200' }} 
                                                        hover:bg-yellow-100/70 transition duration-150
                                                    @endif">
                                                    
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $vendor['shop_name'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ Str::limit($vendor['bio'], 50) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <form action="{{ route('admin.venodrStatus', ['vendor' => $vendor->id]) }}" method="POST" class="inline-flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" id="vendorStatus-{{ $vendor->id }}" 
                                                        class="border border-blue-500 rounded-lg text-sm focus:ring-blue-800 focus:border-blue-500 bg-inherit shadow-sm"
                                                        onchange="this.form.submit()">
                                                        
                                                        <option value="pending" disabled {{ $vendor->status === 'pending' ? 'selected' : ''}}>Pending</option>
                                                        <option value="active"  {{ $vendor->status === 'active' ? 'selected' : ''}}>Active</option>
                                                        <option value="blocked" {{ $vendor->status === 'blocked' ? 'selected' : ''}}>Blocked</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $vendor['created_at']->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>            
            </div>
        </div>
    </div>
</x-app-layout>
