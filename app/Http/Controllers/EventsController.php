<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $event = null;
            if (Auth::user()->role === 'admin') $event = Events::with('user')->get();
            else $event = Events::where('id_master', Auth::id())->get();
            return view('event.index', compact('event'));
        }
    }

    public function create()
    {
        if (Auth::check()) {
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
        $slug = Str::of($validated['name'])->slug('-');
        $event = Events::create([
            'id_master' => Auth::id(),
            'name' => $validated['name'],
            'event_date' => $validated['event_date'],
            'event_start' => $validated['event_start'],
            'event_end' => $validated['event_end'],
            'location' => $validated['location'],
            'thumbnail_img' => $thumbnailPath,
            'user_id' => auth::id(),
            'slug' => $slug,
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Events $slug)
    {
        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $eventParticipants = Events::with('eventParticipants.user')->with('eventParticipants.participant')->findOrFail($event->id);

        // return response()->json([
        //     'event' => $eventParticipants,
        // ]);

        return view('event.show', [
            'event' => $event,
            'participants' => $event->eventParticipants
        ]);
    }

    public function showPreview($slug)
    {
        $event = Events::where('slug', $slug)->firstOrFail();
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

    public function scanner(Events $event)
    {
        return view('event.scan', compact('event'));
    }

    public function scan(Request $request, Events $event)
    {
        if (Auth::check() && Auth::id() == $event->id_master) {
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
        $event['images'] = $event['quad_img'] != null ? explode(', ', $event['quad_img']) : null;
        $creator = $event->creator;

        // Format date and time
        $formattedDate = \Carbon\Carbon::parse($event->event_date)->format('l, F d, Y');
        $formattedStartTime = \Carbon\Carbon::parse($event->event_start)->format('H:i');
        $formattedEndTime = $event->event_end
            ? \Carbon\Carbon::parse($event->event_end)->format('H:i')
            : null;
        // return response()->json($event['images'][0]);
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

        if ($request->deleted_image != '') {
            // Get current images
            $images = $event['quad_img'] != null ? explode(', ', $event['quad_img']) : [];

            $imagesDeleted = explode(',', $request['deleted_image']);
            // return response()->json(['success' => true, 'data' => $imagesDeleted]);
            foreach ($imagesDeleted as $index) {
                // if (isset($images[$index])) {
                // Delete the file from storage
                Storage::disk('public')->delete($images[$index]);

                // Remove the image from the array
                unset($images[$index]);

                // Reindex array and update database
                // }
            }
            $images = array_values($images);
            $event->quad_img = !empty($images) ? implode(', ', $images) : null;
        }

        if ($request->has('has_image') && $request->input('has_image') == 'true') {
            $images = $event['quad_img'] != null ? explode(', ', $event['quad_img']) : [];

            if ($request->hasFile('image_1')) {
                $image1 = $request->file('image_1')->store('images', 'public');
                $images[] = $image1;
            }

            if ($request->hasFile('image_2')) {
                $image2 = $request->file('image_2')->store('images', 'public');
                $images[] = $image2;
            }

            if ($request->hasFile('image_3')) {
                $image3 = $request->file('image_3')->store('images', 'public');
                $images[] = $image3;
            }

            if ($request->hasFile('image_4')) {
                $image4 = $request->file('image_4')->store('images', 'public');
                $images[] = $image4;
            }

            $event->quad_img = implode(', ', $images);
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
