<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materis = Materi::all();

        return view('materi.index', compact('materis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|file|max:10240',
            'cover' => 'required|file|mimes:jpeg,jpg,png|max:10240',
        ]);


        $file = $request->file('file');

        $fileName = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets'), $fileName);

        $cover = $request->file('cover');

        $coverName = time() . '.' . $cover->getClientOriginalExtension();

        $cover->move(public_path('images'), $coverName);

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => 'assets/' . $fileName,
            'cover_path' => 'images/' . $coverName,
        ]);

        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi, $id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();


            $file->move(public_path('assets'), $fileName);
            unlink(public_path($materi->file_path));
            $materi->update(['file_path' => 'assets/' . $fileName]);
        }

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();


            $cover->move(public_path('images'), $coverName);
            unlink(public_path($materi->cover_path));
            $materi->update(['cover_path' => 'images/' . $coverName]);
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('materi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        try {
            unlink(public_path($materi->file_path));
            unlink(public_path($materi->cover_path));
        } catch (\Exception $e) {

        }

        $materi->delete();

        return redirect()->route('materi.index');
    }
}
