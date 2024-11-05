<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $event = Events::all();
        return view('admin.event', compact('event'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_master',
            'name',
            'event_date',
            'event_start',
            'event_end',
            'location',
        ]);

        Events::create($request->all());

        return redirect()->route('home.index')->with('success', 'Event created successfully.');
    }

    public function show(Events $event)
    {
        return view('event.show', compact('event'));
    }

    public function edit(Events $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Events $event)
    {
        $request->validate([
            'id_master',
            'name',
            'event_date',
            'event_start',
            'event_end',
            'location',
        ]);

        $event->update($request->all());

        return redirect()->route('user.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('home.index')->with('success', 'Event deleted successfully.');
    }
}
