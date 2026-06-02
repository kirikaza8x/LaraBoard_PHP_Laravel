<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Project Details Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
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

            <!-- Tasks Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- New Task Button -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-700">Tasks</h3>
                        <a href="{{ route('workspaces.projects.tasks.create', [$workspace, $project]) }}" 
                           class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-900 font-bold shadow-md text-sm">
                            + New Task
                        </a>
                    </div>

                    <!-- Task List -->
                    @forelse ($project->tasks as $task)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded mb-3 border border-gray-200 hover:border-indigo-300 transition">
                            <div>
                                <span class="font-semibold text-gray-800 text-lg">{{ $task->title }}</span>
                                @if($task->description)
                                    <p class="text-sm text-gray-500 mt-1">{{ $task->description }}</p>
                                @endif
                                @if($task->due_date)
                                    <p class="text-xs text-gray-400 mt-1">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</p>
                                @endif
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <span class="text-xs font-bold px-2 py-1 rounded-full 
                                    {{ $task->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                                
                                <!-- Edit Link -->
                                <a href="{{ route('workspaces.projects.tasks.edit', [$workspace, $project, $task]) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                
                                <!-- Delete Form -->
                                <form action="{{ route('workspaces.projects.tasks.destroy', [$workspace, $project, $task]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500 italic">No tasks yet. Click the "+ New Task" button to get started.</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>