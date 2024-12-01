<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // 1. Mengambil semua event
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    // 2. Mengambil detail satu event
    public function show($id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    // 3. Menyimpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json($event, 201);
    }

    // 4. Memperbarui event yang sudah ada
    public function update(Request $request, $id)
{
    $event = Event::find($id);

    if (!$event) {
        return response()->json(['error' => 'Event not found'], 404);
    }

    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
    ]);

    // Update data event
    $event->update([
        'title' => $request->title,
        'description' => $request->description,
        'start' => $request->start,
        'end' => $request->end,
    ]);

    return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
}


    // 5. Menghapus event
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }


public function showModal()
    {
        // Mengembalikan tampilan modal
        return view('components.4-modal'); // Pastikan path ini benar
    }



}


