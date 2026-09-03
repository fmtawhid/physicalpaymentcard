@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">All Tasks</h2>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Assigned User</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Dateline</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Priority</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tasks as $index => $task)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $tasks->firstItem() + $index }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $task->project->title ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $task->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $task->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $task->dateline?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($task->status == 'thinking') bg-gray-100 text-gray-800
                            @elseif($task->status == 'planning') bg-blue-100 text-blue-800
                            @elseif($task->status == 'processing') bg-yellow-100 text-yellow-800
                            @elseif($task->status == 'complete') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($task->priority == 'low') bg-green-100 text-green-800
                            @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.project.tasks.edit', [$task->project, $task]) }}" 
                           class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md transition duration-300">
                           Edit
                        </a>
                        <form method="POST" action="{{ route('admin.project.tasks.destroy', [$task->project, $task]) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md transition duration-300">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No tasks found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center">
        {{ $tasks->links() }}
    </div>
</main>
@endsection