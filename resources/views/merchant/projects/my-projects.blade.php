@extends('merchant.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">My Projects</h2>
                <p class="text-gray-600 mt-1">Projects you've joined</p>
            </div>
            <a href="{{ route('merchant.projects.index') }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transition duration-300">
                Browse More Projects
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

        <!-- Projects List -->
        @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 mb-4 overflow-hidden flex flex-col md:flex-row">
                <!-- Image -->
                <div class="md:w-48 h-32 md:h-auto bg-gray-200 flex-shrink-0">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-primary-50">
                            <i class="fas fa-image text-primary-200 text-4xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 p-4 md:p-6">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $project->title ?? 'Untitled Project' }}</h3>
                            <p class="text-gray-600 text-sm mt-1">
                                Joined on 
                                @if($project->pivot && $project->pivot->joined_at)
                                    {{ \Carbon\Carbon::parse($project->pivot->joined_at)->format('F d, Y') }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                            <i class="fas fa-check mr-1"></i> Active
                        </span>
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($project->description, 150) ?? 'No description' }}</p>

                    <!-- Project Info -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 py-4 border-y border-gray-200">
                        @if($project->start_date)
                            <div>
                                <p class="text-gray-600">Start Date</p>
                                <p class="font-semibold text-gray-800">{{ $project->start_date->format('M d, Y') }}</p>
                            </div>
                        @endif

                        @if($project->end_date)
                            <div>
                                <p class="text-gray-600">End Date</p>
                                <p class="font-semibold text-gray-800">{{ $project->end_date->format('M d, Y') }}</p>
                            </div>
                        @endif

                        @if($project->total_funding)
                            <div>
                                <p class="text-gray-600">Funding</p>
                                <p class="font-semibold text-gray-800">${{ number_format($project->total_funding, 0) }}</p>
                            </div>
                        @endif

                        <div>
                            <p class="text-gray-600">Participants</p>
                            <p class="font-semibold text-gray-800">{{ $project->merchants_count ?? $project->merchants()->count() }}</p>
                        </div>
                    </div>

                    <!-- Investors -->
                    @if($project->investor)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 font-semibold mb-2">Investors & Brands:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $project->investor) as $investor)
                                    <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ trim($investor) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('merchant.projects.show', $project->id) }}" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition duration-300">
                            <i class="fas fa-eye mr-2"></i> View Details
                        </a>
                        <form action="{{ route('merchant.projects.leave', $project->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-300" onclick="return confirm('Are you sure you want to leave this project?')">
                                <i class="fas fa-sign-out-alt mr-2"></i> Leave
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-600 text-xl mb-4">You haven't joined any projects yet</p>
                <a href="{{ route('merchant.projects.index') }}" class="inline-block px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-lg transition duration-300">
                    <i class="fas fa-search mr-2"></i> Browse Projects
                </a>
            </div>
        @endforelse

        <!-- Pagination -->
        @if($projects->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</main>
@endsection
