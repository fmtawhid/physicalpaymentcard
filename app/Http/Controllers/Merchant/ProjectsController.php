<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of all projects
     */
    public function index()
    {
        $user = Auth::user();
        $merchant = $user->merchant;
        
        $projects = Project::withCount('merchants')->paginate(10);
        $joinedProjectIds = $merchant->projects()->pluck('projects.id')->toArray();
        
        return view("merchant.projects.index", compact('projects', 'joinedProjectIds'));
    }

    /**
     * Show single project details
     */
    public function show($id)
    {
        $project = Project::withCount('merchants')->findOrFail($id);
        $user = Auth::user();
        $merchant = $user->merchant;
        $isJoined = $merchant->projects()->where('project_id', $id)->exists();
        $joinedCount = $project->merchants_count;
        
        return view("merchant.projects.show", compact('project', 'isJoined', 'joinedCount'));
    }

    /**
     * Join merchant to a project
     */
    public function join(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $user = Auth::user();
        $merchant = $user->merchant;

        // Check if already joined
        if ($merchant->projects()->where('project_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You have already joined this project');
        }

        // Join project
        $merchant->projects()->attach($id, ['joined_at' => now()]);

        return redirect()->back()->with('success', 'Successfully joined the project');
    }

    /**
     * Leave a project
     */
    public function leave(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $user = Auth::user();
        $merchant = $user->merchant;

        // Check if joined
        if (!$merchant->projects()->where('project_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You are not part of this project');
        }

        // Leave project
        $merchant->projects()->detach($id);

        return redirect()->back()->with('success', 'Successfully left the project');
    }

    /**
     * View merchant's joined projects
     */
    public function myProjects()
    {
        $user = Auth::user();
        $merchant = $user->merchant;
        $projects = $merchant->projects()
            ->withCount('merchants')
            ->paginate(10);
        
        return view("merchant.projects.my-projects", compact('projects'));
    }
}

