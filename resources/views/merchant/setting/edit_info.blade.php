 @extends('merchant.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">

        <h2 class="text-2xl font-semibold mb-6">Edit Merchant Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('merchant.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                {{-- Name --}}
                <div>
                    <label class="block text-gray-700 font-medium">Name *</label>
                    <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $user->name) }}" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-700 font-medium">Email *</label>
                    <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $user->email) }}" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-gray-700 font-medium">Phone *</label>
                    <input type="text" name="phone" class="w-full border px-3 py-2 rounded" value="{{ old('phone', $merchant->phone) }}" required>
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-gray-700 font-medium">Address</label>
                    <textarea name="address" class="w-full border px-3 py-2 rounded">{{ old('address', $merchant->address) }}</textarea>
                </div>

                {{-- Store Name --}}
                <div>
                    <label class="block text-gray-700 font-medium">Store Name</label>
                    <input type="text" name="store_name" class="w-full border px-3 py-2 rounded" value="{{ old('store_name', $merchant->store_name) }}">
                </div>

                {{-- Trade License --}}
                <div>
                    <label class="block text-gray-700 font-medium">Trade License</label>
                    <input type="text" name="trade_license" class="w-full border px-3 py-2 rounded" value="{{ old('trade_license', $merchant->trade_license) }}">
                </div>

                {{-- Wallet Balance --}}
                <div>
                    <label class="block text-gray-700 font-medium">Wallet Balance</label>
                    <input type="number" name="wallet_balance" class="w-full border px-3 py-2 rounded" step="0.01" value="{{ old('wallet_balance', $merchant->wallet_balance) }}">
                </div>

                {{-- Bank Info --}}
                <div>
                    <label class="block text-gray-700 font-medium">Bank Info</label>
                    <textarea name="bank_info" class="w-full border px-3 py-2 rounded">{{ old('bank_info', $merchant->bank_info) }}</textarea>
                </div>

                {{-- NID Number --}}
                <div>
                    <label class="block text-gray-700 font-medium">NID Number</label>
                    <input type="text" name="nid_number" class="w-full border px-3 py-2 rounded" value="{{ old('nid_number', $merchant->nid_number) }}">
                </div>

                {{-- NID Front --}}
                <div>
                    <label class="block text-gray-700 font-medium">NID Front</label>
                    <input type="file" name="nid_front" class="w-full">
                    @if($merchant->nid_front)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_front) }}" class="mt-2 w-32 h-auto border rounded">
                    @endif
                    @error('nid_front') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- NID Back --}}
                <div>
                    <label class="block text-gray-700 font-medium">NID Back</label>
                    <input type="file" name="nid_back" class="w-full">
                    @if($merchant->nid_back)
                        <img src="{{ asset('uploads/merchants/'.$merchant->nid_back) }}" class="mt-2 w-32 h-auto border rounded">
                    @endif
                    @error('nid_back') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Logo --}}
                <div>
                    <label class="block text-gray-700 font-medium">Logo</label>
                    <input type="file" name="logo" class="w-full">
                    @if($merchant->logo)
                        <img src="{{ asset('uploads/merchants/'.$merchant->logo) }}" class="mt-2 w-32 h-auto border rounded">
                    @endif
                    @error('logo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-gray-700 font-medium">Status *</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        <option value="active" {{ $merchant->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $merchant->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Verified --}}
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="verified" value="1" {{ $merchant->verified ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 font-medium">Verified</span>
                    </label>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                        Update Profile
                    </button>
                </div>

            </div>
        </form>
    </div>
</main>
@endsection
