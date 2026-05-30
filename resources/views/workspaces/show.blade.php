<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $workspace->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4"><strong>Description:</strong> {{ $workspace->description ?? 'No description provided.' }}</p>
                    <p class="mb-4"><strong>Slug:</strong> {{ $workspace->slug }}</p>
                    
                    <a href="{{ route('workspaces.index') }}" class="text-indigo-600 hover:text-indigo-900">
                        &larr; Back to all workspaces
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>