<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventParticipantsRequest;
use App\Http\Requests\UpdateEventParticipantsRequest;

class EventParticipantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $participants = EventParticipants::with(['user', 'event'])->get();
        } else {
            $participants = EventParticipants::with(['user', 'event'])
                ->whereHas('event', function($query) {
                    $query->where('id_master', Auth::id());
                })
                ->get();
        }
        return view('admin.eventParticipan', compact('participants'));
    }

    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $events = Events::all();
        } else {
            $events = Events::where('id_master', Auth::id())->get();
        }
        return view('participants.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_event' => 'required|exists:events,id',
            'id_user' => 'required|exists:users,id',
            'status' => 'required|in:pending,confirm',
        ]);

        // Check if user has permission to add participants to this event
        $event = Events::findOrFail($request->id_event);
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        EventParticipants::create($validated);

        return redirect()->route('participants.index')
            ->with('success', 'Participant added successfully.');
    }

    public function show(EventParticipants $participant)
    {
        // Check if user has permission to view this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('participants.show', compact('participant'));
    }

    public function edit(EventParticipants $participant)
    {
        // Check if user has permission to edit this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::user()->role === 'admin') {
            $events = Events::all();
        } else {
            $events = Events::where('id_master', Auth::id())->get();
        }

        return view('participants.edit', compact('participant', 'events'));
    }

    public function update(Request $request, EventParticipants $participant)
    {
        // Check if user has permission to update this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'id_event' => 'required|exists:events,id',
            'id_user' => 'required|exists:users,id',
            'status' => 'required|in:pending,confirm',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')
            ->with('success', 'Participant updated successfully.');
    }

    public function destroy(EventParticipants $participant)
    {
        // Check if user has permission to delete this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $participant->delete();

        return redirect()->route('participants.index')
            ->with('success', 'Participant removed successfully.');
    }
}