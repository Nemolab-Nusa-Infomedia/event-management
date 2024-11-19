<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $event = Events::with('user')->get();
                return view('admin.event', compact('event'));
            }
            $event = Events::where('id_master', Auth::id())->get();
            return view('user.event', compact('event'));
        }
    }

    public function create()
    {
        if(Auth::check()){
            if (Auth::user()->no_telp == null || Auth::user()->alamat == null) {
                return redirect()->route('event.index')->with('error', 'Please complete your personal data first');
            }
            $event = Events::all();
            return view('event.create', compact('event'));
        }
    }

    public function store(Request $request)
    {
        $messages = [
            'thumbnail_img.image' => 'The thumbnail must be an image file.',
            'thumbnail_img.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail_img.max' => 'The thumbnail may not be greater than 2MB.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start' => 'required',
            'event_end' => 'nullable|after:event_start',
            'location' => 'required|string',
            'thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_img')) {
            $thumbnailPath = $request->file('thumbnail_img')->store('event-thumbnails', 'public');
        }

        $event = Events::create([
            'id_master' => Auth::id(),
            'name' => $validated['name'],
            'event_date' => $validated['event_date'],
            'event_start' => $validated['event_start'],
            'event_end' => $validated['event_end'],
            'location' => $validated['location'],
            'thumbnail_img' => $thumbnailPath,
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

    public function showPreview(Events $event)
    {
        // Format dates using Carbon
        $formattedDate = \Carbon\Carbon::parse($event->event_date)->format('l, F d, Y');
        $formattedStartTime = \Carbon\Carbon::parse($event->event_start)->format('H:i');
        $formattedEndTime = $event->event_end 
            ? \Carbon\Carbon::parse($event->event_end)->format('H:i')
            : null;

        // Get creator information
        $creator = User::find($event->id_master);

        return view('home.detailEvent', [
            'event' => $event,
            'formattedDate' => $formattedDate,
            'formattedStartTime' => $formattedStartTime,
            'formattedEndTime' => $formattedEndTime,
            'creator' => $creator
        ]);
    }

    public function scanner(Events $event){
        return view('event.scan', compact('event'));
    }

    public function scan(Request $request,Events $event){
        if(Auth::check() && Auth::id() == $event->id_master){
            // $participant = EventParticipants::where('id_event', '=', $event->id)->where('id_user' , '=', $request->id)->get();
            // $update = $participant->update
            // if($update){
            //     return redirect()->route('event.scan', $event->id);
            // }
        }
    }

    public function detailEvent()
    {
        return view('home.detailEvent');
    }
    public function editEvent()
    {
        return view('home.editEvent');
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

        $messages = [
            'thumbnail_img.image' => 'The thumbnail must be an image file.',
            'thumbnail_img.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail_img.max' => 'The thumbnail may not be greater than 2MB.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start' => 'required',
            'event_end' => 'nullable|after:event_start',
            'location' => 'required|string',
            'thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        if ($request->hasFile('thumbnail_img')) {
            // Delete old thumbnail if exists
            if ($event->thumbnail_img) {
                Storage::disk('public')->delete($event->thumbnail_img);
            }

            // Store new thumbnail
            $validated['thumbnail_img'] = $request->file('thumbnail_img')->store('event-thumbnails', 'public');
        }

        $event->update($validated);

        return redirect()->route('event.index')
            ->with('success', 'Event updated successfully.');
    }

    public function editPreview($id)
    {
        $event = Events::findOrFail($id);
        $creator = $event->creator;
        
        // Format date and time
        $formattedDate = \Carbon\Carbon::parse($event->event_date)->format('l, F d, Y');
        $formattedStartTime = \Carbon\Carbon::parse($event->event_start)->format('H:i');
        $formattedEndTime = $event->event_end 
            ? \Carbon\Carbon::parse($event->event_end)->format('H:i')
            : null;

        return view('home.editEvent', compact('event', 'creator', 'formattedDate', 'formattedStartTime', 'formattedEndTime'));
    }

    public function updatePreview(Request $request, $id)
    {
        $event = Events::findOrFail($id);
        
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string|max:255'
            ]);
            $event->name = $request->name;
        }
        
        if ($request->has('date')) {
            $request->validate([
                'date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'nullable'
            ]);
            $event->event_date = $request->date;
            $event->event_start = $request->start_time;
            $event->event_end = $request->end_time;
        }
        
        if ($request->has('location')) {
            $request->validate([
                'location' => 'required|string|max:500'
            ]);
            $event->location = $request->location;
        }
        
        if ($request->has('about')) {
            $request->validate([
                'about' => 'required|string'
            ]);
            $event->about = $request->about;
        }

        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully'
        ]);
    }

    public function destroy(Events $event)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete thumbnail if exists
        if ($event->thumbnail_img) {
            Storage::disk('public')->delete($event->thumbnail_img);
        }

        $event->delete();
        return redirect()->route('event.index')
            ->with('danger', 'Event deleted successfully.');
    }
}
