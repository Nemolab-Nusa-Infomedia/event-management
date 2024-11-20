<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Middleware\VerifyRole;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            $totalEvent = Events::where('id_master', '=', Auth::id())->count();
            
            // Modified active events counting to only include currently running events
            $eventAktif = Events::where('id_master', '=', Auth::id())
                ->where(function($query) {
                    $now = now();
                    $query->whereDate('event_date', '=', $now->toDateString())
                        ->where('event_start', '<=', $now->format('H:i:s'))
                        ->where('event_end', '>', $now->format('H:i:s'));
                })->count();
            
            // Fix for finished events counting
            $eventSelesai = Events::where('id_master', '=', Auth::id())
                ->where(function($query) {
                    $now = now();
                    $query->whereDate('event_date', '<', $now->toDateString())
                        ->orWhere(function($q) use ($now) {
                            $q->whereDate('event_date', '=', $now->toDateString())
                                ->where('event_end', '<=', $now->format('H:i:s'));
                        });
                })->count();

            $event = Events::where('id_master', '!=', Auth::id())
                ->with('eventParticipants')
                ->get();
            $yourEvent = Events::where('id_master', '=', Auth::id())->get();
            
            return view('home.index', compact('totalEvent', 'eventAktif', 'eventSelesai', 'event', 'yourEvent'));
        }

        // Admin view logic - modified active events counting
        $totalEvent = Events::all()->count();
        $eventAktif = Events::where(function($query) {
            $now = now();
            $query->whereDate('event_date', '=', $now->toDateString())
                ->where('event_start', '<=', $now->format('H:i:s'))
                ->where('event_end', '>', $now->format('H:i:s'));
        })->count();
        
        $eventSelesai = Events::where(function($query) {
            $now = now();
            $query->whereDate('event_date', '<', $now->toDateString())
                ->orWhere(function($q) use ($now) {
                    $q->whereDate('event_date', '=', $now->toDateString())
                        ->where('event_end', '<=', $now->format('H:i:s'));
                });
        })->count();
        
        $event = Events::all();
        $totalUser = User::all()->count();
        return view('dashboard', compact('totalEvent', 'totalUser', 'eventAktif', 'eventSelesai', 'event'));
    }

    public function events(Request $request) {
        if($request->ajax()) {
            $query = Events::query();
            
            // Apply sorting based on category
            switch($request->sort) {
                case 'upcoming':
                    $query->whereDate('event_date', '>=', Carbon::now()->toDateString())
                          ->orderBy('event_date', 'asc')
                          ->orderBy('event_start', 'asc');
                    break;
                case 'created_at':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'all':
                    $query->orderBy('event_date', 'desc')
                          ->orderBy('event_start', 'desc');
                    break;
            }
                
            if($request->createdAt) {
                $query->where('created_at', '<', Carbon::parse($request->createdAt));
            }
            
            $events = $query->take(20)->get()
                ->map(function($event) {
                    $eventDate = Carbon::parse($event->event_date);
                    $eventStart = Carbon::parse($event->event_start);
                    $eventEnd = Carbon::parse($event->event_end);
                    
                    $event->formatted_date = $eventDate->setTimezone('Asia/Jakarta')->format('F d, Y');
                    $event->formatted_start = $eventStart->setTimezone('Asia/Jakarta')->format('g:i A');
                    $event->formatted_end = $eventEnd->setTimezone('Asia/Jakarta')->format('g:i A');
                    
                    $eventDateTime = Carbon::parse($event->event_date . ' ' . $event->event_start)->setTimezone('Asia/Jakarta');
                    $eventEndDateTime = Carbon::parse($event->event_date . ' ' . $event->event_end)->setTimezone('Asia/Jakarta');
                    $now = Carbon::now()->setTimezone('Asia/Jakarta');

                    if ($now->between($eventDateTime, $eventEndDateTime)) {
                        $event->status = 'ongoing';
                    } elseif ($now->greaterThan($eventEndDateTime)) {
                        $event->status = 'ended';
                    } else {
                        $event->status = 'upcoming';
                    }
                    
                    return $event;
                });
                
            return response()->json($events);
        }
        return view('home.events');
    }

    public function joined(){
        $event = Events::whereHas('eventParticipants', function($query) {
            $query->where('id_user', Auth::id());
        })->with(['eventParticipants' => function($query) {
            $query->where('id_user', Auth::id());
        }])->get();
        
        return view('home.joined', compact('event'));
    }

    public function updateStatus(Request $request, $eventId)
    {
        $participant = EventParticipants::where('id_event', $eventId)
            ->where('id_user', Auth::id())
            ->first();

        if ($participant) {
            $participant->update([
                'status' => $request->status
            ]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function Logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/')->with('status', 'Anda telah berhasil logout.');
    }
}