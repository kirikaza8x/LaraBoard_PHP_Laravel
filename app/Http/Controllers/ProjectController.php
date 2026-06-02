<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Workspace $workspace)
    {
        $projects = $workspace->projects;
        return view('projects.index', compact('workspace', 'projects'));
    }

    public function create(Workspace $workspace)
    {
        $this->authorize('create', [Project::class, $workspace]);
        return view('projects.create', compact('workspace'));
    }

    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', [Project::class, $workspace]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $project = $workspace->projects()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('workspaces.projects.show', [$workspace, $project]);
    }

    public function show(Workspace $workspace, Project $project)
    {
        $this->authorize('view', $project);
        $project->load('tasks'); // Load tasks efficiently
        return view('projects.show', compact('workspace', 'project'));
    }

    public function edit(Workspace $workspace, Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('workspace', 'project'));
    }

    public function update(Request $request, Workspace $workspace, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $project->update($validated);
        return redirect()->route('workspaces.projects.show', [$workspace, $project]);
    }

    public function destroy(Workspace $workspace, Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('workspaces.projects.index', $workspace);
    }
}