<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all workspaces for the currently logged-in user
        $workspaces = auth()->user()->workspaces;
        
        return view('workspaces.index', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workspaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $workspace = $request->user()->workspaces()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('workspaces.show', $workspace);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        // Laravel automatically injects the Workspace model here via Route Model Binding
        return view('workspaces.show', compact('workspace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // We will implement this later
        return "Edit page coming soon!";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // We will implement this later
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // We will implement this later
    }
}