<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('dashboard', compact('events'));
    }

    public function show(int $id)
    {
        $event = Event::findOrFail($id);
        return view('event-detail', compact('event'));
    }
}