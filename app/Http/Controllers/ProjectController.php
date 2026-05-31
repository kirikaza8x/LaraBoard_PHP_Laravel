<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Workspace $workspace)
    {
        // Get all projects belonging to this workspace
        $projects = $workspace->projects;

        // Send both the workspace and the list of projects to the view
        return view('projects.index', compact('workspace', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace)
    {
        // Check if user can create a project in this workspace
        $this->authorize('create', [Project::class, $workspace]);

        return view('projects.create', compact('workspace'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Workspace $workspace)
    {
        // Check if user can create a project in this workspace
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

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace, Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.show', compact('workspace', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}