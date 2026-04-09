<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // RETRIEVE
    public function index()
    {
        return Task::where('user_id', auth()->id())->get();
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        return Task::create([
            'title' => $request->title,
            'user_id' => auth()->id()
        ]);
    }

    // UPDATE
    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->title ?? $task->title,
            'is_completed' => $request->is_completed ?? $task->is_completed
        ]);

        return $task;
    }

    // DELETE
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }
}