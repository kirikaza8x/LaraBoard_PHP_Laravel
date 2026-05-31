<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <span class="text-sm font-bold text-gray-500 uppercase">Status:</span>
                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>

                    <p class="mb-4"><strong>Description:</strong> {{ $project->description ?? 'No description provided.' }}</p>
                    
                    @if($project->due_date)
                        <p class="mb-4"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($project->due_date)->format('M d, Y') }}</p>
                    @endif

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('workspaces.projects.index', $workspace) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>