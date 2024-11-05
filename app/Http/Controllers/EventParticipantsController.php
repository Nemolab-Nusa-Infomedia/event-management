<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
// use App\Models\Events;
use App\Http\Requests\StoreEventParticipantsRequest;
use App\Http\Requests\UpdateEventParticipantsRequest;

class EventParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
{
    $participants = EventParticipants::with(['user', 'event'])->get();
    return view('admin.eventParticipan', compact('participants'));
}
    // public function index()
    // {
    //     $participants = EventParticipants::all();
    //     return view('participants.index', compact('participants'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $participants = EventParticipants::all();
        return view('participants.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventParticipantsRequest $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        EventParticipants::create($request->all());

        return redirect()->route('home.index')->with('success', 'Participant added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipants $eventParticipants)
    {
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventParticipants $eventParticipants)
    {
        $participants = EventParticipants::all();
        return view('participants.edit', compact('participant', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventParticipantsRequest $request, EventParticipants $eventParticipants)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $eventParticipants->update($request->all());

        return redirect()->route('home.index')->with('success', 'Participant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventParticipants $eventParticipants)
    {
        $eventParticipants->delete();
        return redirect()->route('home.index')->with('success', 'Participant deleted successfully.');
    }
}
