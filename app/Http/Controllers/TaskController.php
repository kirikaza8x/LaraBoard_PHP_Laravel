<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);
        return view('tasks.create', compact('workspace', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Workspace $workspace, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task = $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'todo',
        ]);

        return redirect()->route('workspaces.projects.show', [$workspace, $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace, Project $project, Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('workspace', 'project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workspace $workspace, Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'in:todo,in_progress,done'],
        ]);

        $task->update($validated);

        return redirect()->route('workspaces.projects.show', [$workspace, $project]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace, Project $project, Task $task)
    {
        $this->authorize('delete', $task);
        
        $task->delete();
        return redirect()->route('workspaces.projects.show', [$workspace, $project]);
    }
}