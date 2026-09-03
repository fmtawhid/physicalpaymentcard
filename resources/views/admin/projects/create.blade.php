@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6">Create Project</h2>

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

        <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Title --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Title</label>
                    <input type="text" name="title" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('title') }}" placeholder="Enter project title">
                </div>

                {{-- URL --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">URL</label>
                    <input type="url" name="url" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('url') }}" placeholder="https://example.com">
                </div>

                {{-- Start Date --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Start Date</label>
                    <input type="date" name="start_date" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('start_date') }}">
                </div>

                {{-- End Date --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">End Date</label>
                    <input type="date" name="end_date" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('end_date') }}">
                </div>

                {{-- Total Funding --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Total Funding</label>
                    <input type="number" name="total_funding" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           step="0.01" value="{{ old('total_funding') }}" placeholder="0.00">
                </div>

                {{-- Investor --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Investor/Brands</label>
                    <input type="text" name="investor" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('investor') }}" placeholder="e.g., Brand A, Brand B, Brand C">
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Image</label>
                    <input type="file" name="image" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           accept="image/jpeg,image/png,image/jpg,image/gif">
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                </div>

                {{-- Description (full width) --}}
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-1 font-semibold">Description</label>
                    <textarea name="description" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 h-24" placeholder="Enter project description">{{ old('description') }}</textarea>
                </div>

            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="px-8 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-300">
                    Create Project
                </button>
                <a href="{{ route('admin.project.list') }}" class="px-8 py-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
@endsection
