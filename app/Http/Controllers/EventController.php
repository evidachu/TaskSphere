<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan halaman utama dengan daftar event
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'event_type' => 'required|string|max:50',
        'reminder' => 'nullable|date',
    ]);

    Event::create([
        'user_id' => auth()->id(), // User yang membuat event
        'title' => $request->title,
        'description' => $request->description,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'event_type' => $request->event_type,
        'reminder' => $request->reminder,
    ]);

    return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
}

    // Menampilkan form edit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        // Pastikan waktu diformat untuk input datetime-local
        $event->start_time = $event->start_time->format('Y-m-d\TH:i');
        $event->end_time = $event->end_time->format('Y-m-d\TH:i');
        return response()->json($event);
    }

    // Menangani update event
    public function update(Request $request, Event $event)
{
    $this->authorize('update', $event); // Pastikan hanya user yang berwenang dapat mengedit

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'event_type' => 'required|string|max:50',
        'reminder' => 'nullable|date',
    ]);

    $event->update([
        'title' => $request->title,
        'description' => $request->description,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'event_type' => $request->event_type,
        'reminder' => $request->reminder,
    ]);

    return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
}

public function destroy(Event $event)
{
    $this->authorize('delete', $event); // Pastikan hanya user yang berwenang dapat menghapus

    $event->delete();
    return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
}


    public function show($id)
{
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
}

public function index()
{
    return view('events.index');
}

public function fetchEvents()
{
    $events = Event::where('user_id', auth()->id()) // Event milik user
        ->orWhere('event_type', 'public') // Event publik
        ->get(['id', 'title', 'start_time as start', 'end_time as end', 'event_type']);

    return response()->json($events); // Kirim dalam format JSON
}




}
