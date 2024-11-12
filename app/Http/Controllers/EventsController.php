<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $event = Events::with('user')->get();
            return view('admin.event', compact('event'));
        } else {
            $event = Events::where('id_master', Auth::id())->get();
            return view('user.event', compact('event'));
        }
    }

    public function create()
    {
        $event = Events::all();
        return view('event.create', compact('event'));
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
            'id_master' => Auth::id(),
            'name' => $validated['name'],
            'event_date' => $validated['event_date'],
            'event_start' => $validated['event_start'],
            'event_end' => $validated['event_end'],
            'location' => $validated['location'],
            'user_id' => auth::id(),
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Events $event)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $eventParticipants = Events::with('eventParticipants.user')->findOrFail($event->id);
        
        return view('event.show', [
            'event' => $event,
            'participants' => $event->eventParticipants
        ]);
    }

    public function edit(Events $event)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Events $event)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start' => 'required',
            'event_end' => 'nullable|after:event_start',
            'location' => 'required|string',
        ]);

        $event->update($validated);

        return redirect()->route('event.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Events $event)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();
        return redirect()->route('event.index')
            ->with('danger', 'Event deleted successfully.');
    }
}