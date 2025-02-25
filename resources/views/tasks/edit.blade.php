@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Task Name</label>
            <input type="text" name="title" id="title" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $task->title }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="form-textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ $task->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-medium mb-2">Image</label>
            @if ($task->image)
                <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" class="w-24 h-auto rounded-md mb-2">
            @endif
            <input type="file" name="image" id="image" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="completed" id="completed" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ $task->completed ? 'checked' : '' }}>
            <label for="completed" class="ml-2 text-gray-700 text-sm font-medium">Completed</label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">Update</button>
    </form>
</div>
@endsection
