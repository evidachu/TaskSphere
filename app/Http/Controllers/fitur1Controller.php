<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User; // Pastikan model User diimpor untuk mencari penanggung jawab berdasarkan nama

class fitur1Controller extends BaseController
{
    /**
     * Constructor untuk Middleware
     */
    public function __construct()
    {
        // Jika login tidak dibutuhkan, middleware auth bisa dihapus
        // $this->middleware('auth'); // Middleware dihapus jika tidak butuh autentikasi
    }

    /**
     * Method untuk menampilkan fitur1
     */
    public function dashboard()
    {
        // Menghitung total tugas
        $totalTasks = Task::count();
        
        // Menghitung persentase progress tugas (jumlah selesai dibagi total)
        $progress = $totalTasks > 0 ? round((Task::where('status', 'Selesai')->count() / $totalTasks) * 100, 2) : 0;
    
        // Mengambil semua data tugas dan mengurutkannya berdasarkan deadline
        $tasks = Task::select('id', 'name', 'assignee_id', 'assignee_name', 'status', 'deadline')
                     ->orderBy('deadline', 'asc')
                     ->get();
    
        // Ganti 'dashboard' menjadi 'fitur1' untuk merujuk ke file fitur1.blade.php
        return view('fitur1', compact('tasks', 'progress'));  // Pastikan progress dikirim ke view
    }

    /**
     * Method untuk menampilkan detail tugas
     */
    public function showTask($id)
    {
        // Cari tugas berdasarkan ID
        $task = Task::findOrFail($id);

        // Kirim data tugas ke view
        return view('task', compact('task'));
    }

    /**
     * Method untuk memperbarui status dan hasil tugas
     */
    public function updateTask(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Belum Dimulai,Sedang Dikerjakan,Selesai',
            'result' => 'nullable|string',
        ]);

        // Cari tugas berdasarkan ID
        $task = Task::findOrFail($id);

        // Perbarui status dan hasil tugas
        $task->update([
            'status' => $request->status,
            'result' => $request->result,
        ]);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Method untuk menambahkan tugas baru via AJAX
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'assignee_name' => 'required|string', // Menggunakan nama penanggung jawab
            'status' => 'required|in:Belum Dimulai,Sedang Dikerjakan,Selesai',
            'deadline' => 'required|date',
        ]);

        // Cari ID penanggung jawab berdasarkan nama
        $assignee = User::where('name', $request->assignee_name)->first();

        // Jika penanggung jawab tidak ditemukan, beri pesan error
        if (!$assignee) {
            return response()->json(['error' => 'Penanggung jawab tidak ditemukan!'], 404);
        }

        // Simpan tugas baru ke database
        $task = Task::create([
            'name' => $request->name,
            'assignee_id' => $assignee->id, // Simpan ID penanggung jawab
            'assignee_name' => $assignee->name, // Simpan nama penanggung jawab
            'status' => $request->status,
            'deadline' => $request->deadline,
            'result' => $request->result, // Jika diperlukan
        ]);

        // Kembalikan data tugas yang baru disimpan dalam format JSON
        return response()->json([
            'success' => 'Tugas berhasil ditambahkan!',
            'task' => $task, // Mengembalikan data tugas yang baru disimpan
        ]);
    }
}
