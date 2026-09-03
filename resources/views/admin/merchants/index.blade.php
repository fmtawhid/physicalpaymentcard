@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Merchants List</h2>
        <a href="{{ route('admin.merchant.create') }}" 
           class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            Add Merchant
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Verified</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($merchants as $index => $merchant)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $merchant->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $merchant->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $merchant->phone }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $merchant->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($merchant->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $merchant->verified ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $merchant->verified ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.merchant.edit', $merchant->id) }}" 
                           class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md transition duration-300">
                           Edit
                        </a>
                        <form method="POST" action="{{ route('admin.merchant.destroy', $merchant->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md transition duration-300">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
