<?php

namespace App\Http\Controllers;

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

    public function events(Request $request){
        if($request->ajax()){
            if($request->createdAt == 0){
                $events = Events::orderByDesc('created_at')->take(20)->get();
                return response()->json($events);
            }
            $events = Events::orderByDesc('created_at')->where('created_at', '<', $request->createdAt)->take(20)->get();
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