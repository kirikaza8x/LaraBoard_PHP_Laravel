<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Workspaces') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <a href="{{ route('workspaces.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-indigo-700">
                        + New Workspace
                    </a>

                    @forelse ($workspaces as $workspace)
                        <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route('workspaces.show', $workspace) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $workspace->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600">{{ $workspace->description }}</p>
                            </div>
                            
                            <form action="{{ route('workspaces.destroy', $workspace) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all projects and tasks inside.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium border border-red-200 px-3 py-1 rounded hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <p>You don't have any workspaces yet.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>