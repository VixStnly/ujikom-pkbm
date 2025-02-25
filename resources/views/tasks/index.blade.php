@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Add New Task</a>
    
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md mt-4">{{ session('success') }}</div>
    @endif
    
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Task Name</th>
                    <th class="py-3 px-4 text-left">Description</th>
                   
                    <th class="py-3 px-4 text-left">Author</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($tasks as $task)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4">
                        @if ($task->image)
                        <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" class="w-10 h-10 rounded-full object-cover">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $task->title }}</td>
                    <td class="py-3 px-4">{{ $task->description }}</td>
                    
                    <td class="py-3 px-4">{{ $task->user ? $task->user->name : 'Unknown' }}</td>
                    <td class="py-3 px-4">{{ $task->completed ? 'Completed' : 'Pending' }}</td>
                    <td class="py-3 px-4 flex items-center justify-center space-x-2">
    <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-300">Edit</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-300">Delete</button>
    </form>
</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
