<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskMangement extends Controller
{
    // Display a list of tasks, separated into completed and incomplete
    public function index()
    {
        $user = auth()->user();
        $tasks = $user->tasks; // Fetch tasks for the authenticated user

        $completedTasks = $tasks->where('completed', true);
        $incompleteTasks = $tasks->where('completed', false);

        return view('dashboard')->with([
            'completedTasks' => $completedTasks,
            'incompleteTasks' => $incompleteTasks,
        ]);
    }

    // Add a new task
    public function Add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'due_date' => 'required|date',
            'category' => 'required|string|in:Work,Study,Personal',
        ]);

        $user = auth()->user(); // Get the authenticated user

        $task = $user->tasks()->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'Due_Date' => $validatedData['due_date'],
            'category' => $validatedData['category'],
            'completed' => false,
        ]);

        if ($task) {
            return redirect()->back()->with('success', 'Task added successfully!');
        } else {
            return redirect()->back()->with('Error', 'Try again later');
        }
    }


    // Mark a task as completed
    public function complete($id)
    {
        $user = auth()->user();
        $task = $user->tasks()->find($id);

        if ($task) {
            $task->update(['completed' => true]);
            return redirect()->back()->with('success', 'Task Completed');
        }

        return redirect()->back()->with('error', 'Task not found.');
    }


    // Delete a task
    public function delete($id)
    {
        $user = auth()->user();
        $task = $user->tasks()->find($id);

        if ($task) {
            $task->delete();
            return redirect()->back()->with('success', 'Task deleted successfully.');
        }

        return redirect()->back()->with('error', 'Task not found.');
    }
}
