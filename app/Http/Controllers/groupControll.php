<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class groupControll extends Controller
{
    public function index()
    {
        $groups = Group::paginate(10);
        return view('groups.index', compact('groups'));
    }

    // Halaman Buat Grup Baru
    public function create()
    {
        return view('groups.create');
    }

    // Simpan Grup Baru
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'subject' => 'required',
            'max_members' => '50'
        ]);

        $group = Group::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'subject' => $validatedData['subject'],
            'creator_id' => Auth::id(),
            'max_members' => $validatedData['50']

        ]);

        $groups = Group::all();  // Ambil semua grup dari database
            return view('groups.create', compact('groups'));

            $validatedData = $request->validate([
                'name' => 'required|unique:groups|max:255',
                'subject' => 'required|max:255',
                'description' => 'required|max:1000',
            ]);

        // Tambahkan pembuat sebagai anggota pertama
        $group->members()->attach(Auth::id());

        return redirect()->route('groups.create');
        // return redirect()->route('groups.show', $group)->with('success', 'Grup berhasil dibuat');
    }

    // Tampilkan Detail Grup
    public function show(Group $group)
    {
        $group->load('members', 'learningSessions', 'documents');
        return view('groups.show', compact('group'));
    }

    // Edit Grup
    public function edit(Group $group)
    {
        // Pastikan hanya pembuat yang bisa edit
        $this->authorize('update', $group);
        return view('groups.edit', compact('group'));
    }

    // Update Grup
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'subject' => 'required',
            'max_members' => '50'
        ]);

        $group->update($validatedData);

        return redirect()->route('groups.show', $group)->with('success', 'Grup berhasil diupdate');
    }

    // Hapus Grup
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Grup berhasil dihapus');
    }

    // Bergabung dengan Grup
    public function join(Group $group)
    {
        $group = Group::find($id);
        $group = Group::findOrFail($groupId);

        // Logic untuk menambah anggota ke dalam grup
        $user = auth()->user();

        // Menambahkan user yang sedang login ke grup
        $group->members()->attach($user->id); // Pastikan ada relasi many-to-many antara User dan Group

        // Redirect ke halaman grup chat atau halaman diskusi
        return redirect()->route('groups.create');
    }

    // Keluar dari Grup
    public function leave(Group $group)
    {
        $user = Auth::user();
        $group->members()->detach($user->id);

        return back()->with('success', 'Anda telah keluar dari grup');
    }

    // Pencarian Grup
    public function search(Request $request)
    {
        $query = $request->input('query');

        $groups = Group::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('subject', 'LIKE', "%{$query}%")
                       ->paginate(10);

        return view('groups.index', compact('groups', 'query'));

        $validatedData = $request->validate([
            'name' => 'required|unique:groups,name',
            'subject' => 'required',
            'description' => 'required',
        ]);

        // Membuat grup baru


        // Redirect kembali ke daftar grup setelah membuat grup baru
        return redirect()->route('groups.index');
    }


}
