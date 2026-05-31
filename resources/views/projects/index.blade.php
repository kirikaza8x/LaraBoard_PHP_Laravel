<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Projects in {{ $workspace->name }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('workspaces.projects.create', $workspace) }}"
                class="inline-flex items-center bg-purple-600 text-white px-5 py-3 rounded-lg mb-6 font-bold shadow-md hover:bg-purple-700 transition duration-150 ease-in-out">
                + New Project
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">









                    @forelse ($projects as $project)
                        <div class="border-b border-gray-200 py-4 last:border-0">
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
                    @empty
                        <p class="text-gray-500 italic">No projects yet. Click the button above to create one.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>