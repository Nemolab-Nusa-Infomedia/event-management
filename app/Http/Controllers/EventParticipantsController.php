<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailSenderController;
use App\Http\Requests\StoreEventParticipantsRequest;
use App\Http\Requests\UpdateEventParticipantsRequest;

class EventParticipantsController extends Controller
{
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
        $event = Events::findOrFail($request->id_event);

        if (!$event) return redirect()->back()->with('fail', 'Cannot add participant');

        // $event = Events::where('id', '=', $request['id_event'])->get();
        $validated = $request->validate([
            'id_user' => ['sometimes'],
            'id_event' => ['required', 'exists:events,id'],
            'name' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required'],
            'alamat' => ['required'],
            'for_me' => ['sometimes'],
        ]);

        if (Auth::check() && $validated['for_me'] == true) {
            $user = User::findOrFail($validated['id_user'])->where('name', '=', $validated['name'])->where('email', '=', $validated['email'])->where('no_telp', '=', $validated['no_telp'])->where('alamat', '=', $validated['alamat'])->where('role', '=', 'user');

            return redirect()->back()->with('fail', 'Use same data with your account');
        }

        $eventParticipant = EventParticipants::create($validated);

        if (!$request->has('for_me')) {
            $data = [
                'id_event' => $eventParticipant->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
                'alamat' => $validated['alamat'],
            ];
            Participants::create($data);
        }
        // return response()->json([$request, $validated]);


        if ($event) {
            MailSenderController::SendNotif($validated, $eventParticipant->id);
            return redirect()->route(Auth::check() ? 'joined' : 'welcome')
                ->with('success', 'Participant added successfully.');
        }

        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            return redirect()->route('home')
                ->with('success', 'Participant added successfully.');
        }
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
