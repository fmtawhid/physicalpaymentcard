@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6">Create Merchant</h2>

        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.merchant.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Name --}}
                <div>
                    <label class="block text-gray-700 mb-1">Name *</label>
                    <input type="text" name="name" class="w-full border px-3 py-2 rounded"
                           value="{{ old('name') }}" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" class="w-full border px-3 py-2 rounded"
                           value="{{ old('email') }}" required>
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-gray-700 mb-1">Phone *</label>
                    <input type="text" name="phone" class="w-full border px-3 py-2 rounded"
                           value="{{ old('phone') }}" required>
                </div>

                {{-- Address (full width) --}}
                <div class="md:col-span-3">
                    <label class="block text-gray-700 mb-1">Address</label>
                    <textarea name="address" class="w-full border px-3 py-2 rounded">{{ old('address') }}</textarea>
                </div>

                {{-- Store Name --}}
                <div>
                    <label class="block text-gray-700 mb-1">Store Name</label>
                    <input type="text" name="store_name" class="w-full border px-3 py-2 rounded"
                           value="{{ old('store_name') }}">
                </div>

                {{-- Trade License --}}
                <div>
                    <label class="block text-gray-700 mb-1">Trade License</label>
                    <input type="text" name="trade_license" class="w-full border px-3 py-2 rounded"
                           value="{{ old('trade_license') }}">
                </div>

                {{-- Wallet Balance --}}
                <div>
                    <label class="block text-gray-700 mb-1">Wallet Balance</label>
                    <input type="number" name="wallet_balance" class="w-full border px-3 py-2 rounded"
                           step="0.01" value="{{ old('wallet_balance') }}">
                </div>

                {{-- Bank Info (full width) --}}
                <div class="md:col-span-3">
                    <label class="block text-gray-700 mb-1">Bank Info</label>
                    <textarea name="bank_info" class="w-full border px-3 py-2 rounded">{{ old('bank_info') }}</textarea>
                </div>

                {{-- NID Number --}}
                <div>
                    <label class="block text-gray-700 mb-1">NID Number</label>
                    <input type="text" name="nid_number" class="w-full border px-3 py-2 rounded"
                           value="{{ old('nid_number') }}">
                </div>

                {{-- NID Front --}}
                <div>
                    <label class="block text-gray-700 mb-1">NID Front</label>
                    <input type="file" name="nid_front" class="w-full border px-3 py-2 rounded">
                </div>

                {{-- NID Back --}}
                <div>
                    <label class="block text-gray-700 mb-1">NID Back</label>
                    <input type="file" name="nid_back" class="w-full border px-3 py-2 rounded">
                </div>

                {{-- Logo (full width) --}}
                <div class="md:col-span-3">
                    <label class="block text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" class="w-full border px-3 py-2 rounded">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-gray-700 mb-1">Password *</label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-gray-700 mb-1">Confirm Password *</label>
                    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-gray-700 mb-1">Status *</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Verified checkbox --}}
                <div class="flex items-center md:col-span-3 mt-2">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="verified" value="1" {{ old('verified') ? 'checked' : '' }}>
                        <span>Verified</span>
                    </label>
                </div>

            </div>

            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save Merchant
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
