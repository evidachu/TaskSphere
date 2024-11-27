<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_completed' => 'required|boolean',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_completed' => 'required|boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
