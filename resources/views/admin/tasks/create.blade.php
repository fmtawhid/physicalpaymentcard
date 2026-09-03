@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6">Create Task for Project: {{ $project->title }}</h2>

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

        <form action="{{ route('admin.project.tasks.store', $project) }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Name --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('name') }}" placeholder="Enter task name" required>
                </div>

                {{-- Assigned User --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Assigned User</label>
                    <select name="user_id" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dateline --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Dateline</label>
                    <input type="date" name="dateline" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('dateline') }}">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Status</label>
                    <select name="status" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="thinking" {{ old('status', 'thinking') == 'thinking' ? 'selected' : '' }}>Thinking</option>
                        <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                        <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>

                {{-- Priority --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold">Priority</label>
                    <select name="priority" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="low" {{ old('priority', 'medium') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                {{-- Note (full width) --}}
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-1 font-semibold">Note</label>
                    <textarea name="note" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 h-24" placeholder="Enter task note">{{ old('note') }}</textarea>
                </div>

            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="px-8 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-300">
                    Create Task
                </button>
                <a href="{{ route('admin.project.tasks.index', $project) }}" class="px-8 py-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
@endsection