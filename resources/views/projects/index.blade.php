<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Projects in {{ $workspace->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Button moved INSIDE the card for better alignment -->
                    <a href="{{ route('workspaces.projects.create', $workspace) }}" 
                       class="bg-slate-800 text-white px-4 py-2 rounded mb-6 inline-block hover:bg-slate-900 font-bold shadow-md transition duration-150">
                        + New Project
                    </a>

                    @forelse ($projects as $project)
                        <div class="border-b border-gray-200 py-4 flex justify-between items-center last:border-0">
                            <div>
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">
                                        {{ $project->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mt-1">{{ $project->description }}</p>
                                <span class="inline-block mt-2 text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>

                            <form action="{{ route('workspaces.projects.destroy', [$workspace, $project]) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all tasks inside.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium border border-red-200 px-3 py-1 rounded hover:bg-red-50 transition duration-150">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No projects yet. Click the button above to create one.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>