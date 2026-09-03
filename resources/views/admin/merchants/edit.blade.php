@extends('merchant.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">

        <h2 class="text-xl font-semibold mb-4">Edit Merchant</h2>

        <form method="POST" action="{{ route('admin.merchant.update', $merchant->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>
                    <label class="block text-gray-700">Name *</label>
                    <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $merchant->name) }}" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Email *</label>
                    <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $merchant->email) }}" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Phone *</label>
                    <input type="text" name="phone" class="w-full border px-3 py-2 rounded" value="{{ old('phone', $merchant->phone) }}" required>
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Address</label>
                    <textarea name="address" class="w-full border px-3 py-2 rounded">{{ old('address', $merchant->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700">Store Name</label>
                    <input type="text" name="store_name" class="w-full border px-3 py-2 rounded" value="{{ old('store_name', $merchant->store_name) }}">
                </div>

                <div>
                    <label class="block text-gray-700">Trade License</label>
                    <input type="text" name="trade_license" class="w-full border px-3 py-2 rounded" value="{{ old('trade_license', $merchant->trade_license) }}">
                </div>

                <div>
                    <label class="block text-gray-700">Wallet Balance</label>
                    <input type="number" name="wallet_balance" class="w-full border px-3 py-2 rounded" step="0.01" value="{{ old('wallet_balance', $merchant->wallet_balance) }}">
                </div>

                <div>
                    <label class="block text-gray-700">Bank Info</label>
                    <textarea name="bank_info" class="w-full border px-3 py-2 rounded">{{ old('bank_info', $merchant->bank_info) }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700">NID Number</label>
                    <input type="text" name="nid_number" class="w-full border px-3 py-2 rounded" value="{{ old('nid_number', $merchant->nid_number) }}">
                </div>

                <div>
                    <label class="block text-gray-700">NID Front</label>
                    <input type="file" name="nid_front" class="w-full">
                    @if($merchant->nid_front)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_front) }}" class="mt-2 w-32">
                    @endif
                </div>

                <div>
                    <label class="block text-gray-700">NID Back</label>
                    <input type="file" name="nid_back" class="w-full">
                    @if($merchant->nid_back)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_back) }}" class="mt-2 w-32">
                    @endif
                </div>

                <div>
                    <label class="block text-gray-700">Logo</label>
                    <input type="file" name="logo" class="w-full">
                    @if($merchant->logo)
                        <img src="{{ asset('uploads/merchants/'.$merchant->logo) }}" class="mt-2 w-32">
                    @endif
                </div>

                <div>
                    <label class="block text-gray-700">Status *</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="active" {{ $merchant->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $merchant->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="verified" value="1" {{ $merchant->verified ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Verified</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded transition duration-300">
                        Update Merchant
                    </button>
                </div>

            </div>
        </form>
    </div>
</main>
@endsection
