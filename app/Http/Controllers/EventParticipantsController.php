<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
use App\Http\Requests\StoreEventParticipantsRequest;
use App\Http\Requests\UpdateEventParticipantsRequest;

class EventParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventParticipantsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipants $eventParticipants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventParticipants $eventParticipants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventParticipantsRequest $request, EventParticipants $eventParticipants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventParticipants $eventParticipants)
    {
        //
    }
}
