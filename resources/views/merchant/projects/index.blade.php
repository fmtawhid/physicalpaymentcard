@extends('merchant.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Browse Projects</h2>
                <p class="text-gray-600 mt-1">Discover and join available projects</p>
            </div>
            <a href="{{ route('merchant.projects.my') }}" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                My Projects
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-green-700 font-bold">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-red-700 font-bold">×</button>
            </div>
        @endif

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                    <!-- Image -->
                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-primary-50">
                                <i class="fas fa-image text-primary-200 text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Badge for joined status -->
                        @if(in_array($project->id, $joinedProjectIds))
                            <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                <i class="fas fa-check mr-1"></i> Joined
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">{{ $project->title ?? 'Untitled Project' }}</h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($project->description, 80) ?? 'No description' }}</p>

                        <!-- Project Info -->
                        <div class="space-y-2 mb-4 text-sm text-gray-600">
                            @if($project->start_date)
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-primary-600 mr-2 w-4"></i>
                                    <span>{{ $project->start_date->format('M d, Y') }}</span>
                                </div>
                            @endif

                            @if($project->total_funding)
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign text-primary-600 mr-2 w-4"></i>
                                    <span>${{ number_format($project->total_funding, 0) }}</span>
                                </div>
                            @endif

                            @if($project->investor)
                                <div class="flex items-center">
                                    <i class="fas fa-building text-primary-600 mr-2 w-4"></i>
                                    <span class="truncate">{{ Str::limit($project->investor, 30) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('merchant.projects.show', $project->id) }}" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-300 text-center">
                                View
                            </a>
                            
                            @if(in_array($project->id, $joinedProjectIds))
                                <form action="{{ route('merchant.projects.leave', $project->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-300">
                                        Leave
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('merchant.projects.join', $project->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition duration-300">
                                        Join
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-600 text-lg">No projects available yet</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $projects->links() }}
        </div>
    </div>
</main>
@endsection
