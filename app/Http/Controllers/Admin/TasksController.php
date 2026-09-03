<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of all tasks.
     */
    public function generalIndex()
    {
        $tasks = Task::with('project', 'user')->paginate(10);
        return view('admin.tasks.general_index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $users = User::all();
        return view('admin.tasks.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'dateline' => 'nullable|date',
            'status' => 'required|in:thinking,planning,processing,complete,cancel',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return redirect()->route('admin.project.tasks.index', $project)
            ->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $users = User::all();
        return view('admin.tasks.edit', compact('project', 'task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'dateline' => 'nullable|date',
            'status' => 'required|in:thinking,planning,processing,complete,cancel',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($validated);

        return redirect()->route('admin.project.tasks.index', $project)
            ->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('admin.project.tasks.index', $project)
            ->with('success', 'Task deleted successfully');
    }
}
