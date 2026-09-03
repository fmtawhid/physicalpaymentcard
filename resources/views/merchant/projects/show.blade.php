@extends('merchant.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('merchant.projects.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Projects
        </a>

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

        <!-- Project Header Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <!-- Image -->
            <div class="relative h-80 bg-gray-200 overflow-hidden">
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-primary-50">
                        <i class="fas fa-image text-primary-200 text-6xl"></i>
                    </div>
                @endif

                <!-- Join Status Badge -->
                <div class="absolute top-4 right-4">
                    @if($isJoined)
                        <div class="bg-green-500 text-white px-4 py-2 rounded-full font-semibold flex items-center">
                            <i class="fas fa-check mr-2"></i> You Joined
                        </div>
                    @else
                        <div class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold flex items-center">
                            <i class="fas fa-users mr-2"></i> {{ $joinedCount }} Merchant(s)
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $project->title ?? 'Untitled Project' }}</h1>
                
                <p class="text-gray-600 text-lg mb-6">{{ $project->description ?? 'No description available' }}</p>

                <!-- Project Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 py-6 border-y border-gray-200">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-calendar text-primary-600 mr-3"></i> Timeline
                        </h3>
                        <div class="space-y-3">
                            @if($project->start_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Start Date:</span>
                                    <span class="font-semibold text-gray-800">{{ $project->start_date->format('F d, Y') }}</span>
                                </div>
                            @endif
                            @if($project->end_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">End Date:</span>
                                    <span class="font-semibold text-gray-800">{{ $project->end_date->format('F d, Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-dollar-sign text-primary-600 mr-3"></i> Funding
                        </h3>
                        <div class="space-y-3">
                            @if($project->total_funding)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Funding:</span>
                                    <span class="font-semibold text-gray-800 text-xl text-primary-600">${{ number_format($project->total_funding, 2) }}</span>
                                </div>
                            @else
                                <p class="text-gray-500">Funding info not specified</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Investors/Brands -->
                @if($project->investor)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-building text-primary-600 mr-3"></i> Investors & Brands
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->investor) as $investor)
                                <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full font-semibold text-sm">
                                    {{ trim($investor) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Project URL -->
                @if($project->url)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-link text-primary-600 mr-3"></i> Project Link
                        </h3>
                        <a href="{{ $project->url }}" target="_blank" class="text-primary-600 hover:text-primary-700 hover:underline break-all">
                            {{ $project->url }}
                            <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                        </a>
                    </div>
                @endif

                <!-- Participants Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                    <div class="flex items-center">
                        <i class="fas fa-users text-blue-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $joinedCount }} merchant(s) already joined</p>
                            <p class="text-sm text-gray-600">Join this project to collaborate</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    @if($isJoined)
                        <form action="{{ route('merchant.projects.leave', $project->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg transition duration-300" onclick="return confirm('Are you sure you want to leave this project?')">
                                <i class="fas fa-sign-out-alt mr-2"></i> Leave Project
                            </button>
                        </form>
                    @else
                        <form action="{{ route('merchant.projects.join', $project->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-lg transition duration-300">
                                <i class="fas fa-sign-in-alt mr-2"></i> Join Project
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('merchant.projects.index') }}" class="flex-1 px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300 text-center">
                        <i class="fas fa-list mr-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
