<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Menampilkan semua proyek.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all(); // Mengambil semua proyek
        return view('projects.index', compact('projects')); // Mengirim data ke view
    }

    /**
     * Menampilkan semua tugas dalam proyek tertentu.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        $tasks = $project->tasks()->with('user')->get(); // Mengambil semua tugas terkait proyek
        return view('projects.tasks', compact('project', 'tasks')); // Mengirim data ke view
    }

    /**
     * Mengambil tugas oleh user yang login.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignTask(Task $task)
    {
        if ($task->assigned_to) {
            return redirect()->back()->with('error', 'Tugas ini sudah diambil oleh orang lain.');
        }

        $task->update(['assigned_to' => Auth::id()]); // Mengaitkan tugas dengan user yang login
        return redirect()->back()->with('success', 'Tugas berhasil diambil!');
    }

    /**
     * Memperbarui status tugas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:Belum Dimulai,Sedang Dikerjakan,Selesai', // Validasi input status
        ]);

        if ($task->assigned_to !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak memperbarui tugas ini.');
        }

        $task->update(['status' => $request->status]); // Memperbarui status tugas
        return redirect()->back()->with('success', 'Status tugas berhasil diperbarui!');
    }
}
