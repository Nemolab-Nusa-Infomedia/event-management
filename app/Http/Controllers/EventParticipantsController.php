<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailSenderController;
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
                ->whereHas('event', function ($query) {
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
        // $event = Events::where('id', '=', $request['id_event'])->get();
        // return response()->json($event[0]['name']);
        $validated = $request->validate([
            'id_event' => ['required', 'exists:events,id'],
            'id_user' => ['required', 'exists:users,id'],
        ]);


        EventParticipants::create($validated);

        $event = Events::findOrFail($request->id_event);
        if ($event) {
            MailSenderController::SendNotif($request);
            return redirect()->route('joined')
                ->with('success', 'Participant added successfully.');
        }
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            return redirect()->route('home')
                ->with('success', 'Participant added successfully.');
        }
        return redirect()->route('joined')->with('fail', 'Cannot add participant');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipants $eventParticipants)
    {
        return view('event.show', compact('eventParticipants'));
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

        return redirect()->route('joined')
            ->with('success', 'Participant updated successfully.');
    }

    public function destroy(EventParticipants $eventParticipan)
    {
        if (Auth::user()->role === 'admin' || $eventParticipan->event->id_master === Auth::id()) {
            $eventParticipan->delete();

            return redirect()->route('event.show', $eventParticipan->id_event)
                ->with('success', 'Participant removed successfully.');
        }

        abort(403, 'Unauthorized action.');
    }

    public function scan(Request $request, EventParticipants $eventParticipan)
    {
        $id_master = Events::find($eventParticipan->id_event, ['id_master']);
        if (Auth::check() && Auth::id() == $id_master['id_master']) {
            if ($eventParticipan->status == 'Present') return response()->json(['message' => 'Invalid or already used QR code.'], 409);

            $validated = $request->validate([
                'status' => ['required', 'regex:/^Present$/'],
            ]);

            $eventParticipan->update($validated);
            return response()->json(['message' => 'QR code verified successfully.'], 200);
        }
        return response()->json(['message' => 'you not have permission'], 403);
    }
}
