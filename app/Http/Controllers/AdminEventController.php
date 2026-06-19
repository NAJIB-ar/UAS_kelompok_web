<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    // daftar semua seminar
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    // form tambah seminar
    public function create()
    {
        return view('admin.events.create');
    }

    // tambah data ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'category' => 'required|string',
            'type' => 'required|in:online,offline',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'price' => 'required|integer|min:0',
            'ticket_quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        // upload poster seminar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('event_posters', 'public');
        }

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Seminar baru berhasil ditambahkan!');
    }

    //form edit seminar
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // edit data
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'category' => 'required|string',
            'type' => 'required|in:online,offline',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'price' => 'required|integer|min:0',
            'ticket_quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('event_posters', 'public');
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Data seminar berhasil diperbarui!');
    }

    // Menghapus seminar
    public function destroy(Event $event)
    {
        // Hapus gambar dari storage
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Seminar berhasil dihapus!');
    }
}