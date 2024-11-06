<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
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
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'event_date' => 'required|date',
        'event_start' => 'required',
        'event_end' => 'nullable|after:event_start',
        'location' => 'required|string',
    ]);

    $event = Events::create([
        'id_master' => 1,
        'name' => $validated['name'],
        'event_date' => $validated['event_date'],
        'event_start' => $validated['event_start'],
        'event_end' => $validated['event_end'],
        'location' => $validated['location'],
    ]);

    return redirect()->route('event.index')
        ->with('success', 'Event created successfully.');
    }

    public function show(Events $event)
    {
        $eventParticipants = Events::with('EventParticipants')->findOrFail( $event->id);
        $dataParticipants = EventParticipants::with(relations: 'User')->findMany($eventParticipants['eventParticipants']);
        $participants = $dataParticipants;
        return view('event.show', [
            'event' => $event,
            'participants' => $participants
        ]);
        // return view('event.show', compact('participants'));
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

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('home.index')->with('success', 'Event deleted successfully.');
    }
}
