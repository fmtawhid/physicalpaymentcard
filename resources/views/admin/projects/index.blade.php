@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Projects Management</h2>
        <a href="{{ route('admin.project.create') }}" 
           class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            Add Project
        </a>
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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">URL</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Start Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">End Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Funding</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Investor</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Tasks</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($projects as $index => $project)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $projects->firstItem() + $index }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="Project" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400">No image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $project->title ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ Str::limit($project->url, 30) }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $project->start_date?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $project->end_date?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                        {{ $project->total_funding ? '$' . number_format($project->total_funding, 2) : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $project->investor ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <a href="{{ route('admin.project.tasks.index', $project) }}" class="text-blue-600 hover:underline">
                            View Tasks ({{ $project->tasks->count() }})
                        </a>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.project.edit', $project->id) }}" 
                           class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md transition duration-300">
                           Edit
                        </a>
                        <form method="POST" action="{{ route('admin.project.destroy', $project->id) }}" style="display: inline;">
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
                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">No projects found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center">
        {{ $projects->links() }}
    </div>
</main>
@endsection
