<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{
    public function index()
    { $fiveTasks = Task::orderBy('created_at', 'desc')->take(5)->get();
        $tasks = Task::with('user')->get(); // Eager load user data
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'completed' => 'nullable|boolean',
        ]);

        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed', false); // Default to false if not provided
        $task->user_id = auth()->id(); // Set user_id to the currently authenticated user

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $task->image = 'images/' . $filename;
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'completed' => 'nullable|boolean',
        ]);

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed', false);

        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($task->image) {
                \Storage::delete('public/' . $task->image);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $task->image = 'images/' . $filename;
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    public function destroy(Task $task)
{
    // Hapus gambar terkait jika ada
    if ($task->image) {
        \Storage::delete('public/' . $task->image);
    }

    // Hapus task
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
}
}
