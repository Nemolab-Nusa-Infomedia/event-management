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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            $totalEvent = Events::where('id_master', '=', Auth::id())->count();
            $eventAktif = Events::where('id_master', '=', Auth::id())->where('event_date', '=', now()->toDateString())->where('event_start', '<', now())->where('event_end', '>', now())->get()->count();
            $eventSelesai = Events::where('id_master', '=', Auth::id())->where('event_date', '<=', now()->toDateString())->where('event_end', '<', now())->get()->count();
            $event = Events::where('id_master', '!=', Auth::id())->with('eventParticipants')->get();
            $yourEvent = Events::where('id_master', '=', Auth::id())->get();
            return view('home.index', compact('totalEvent', 'eventAktif', 'eventSelesai', 'event', 'yourEvent'));
            // return response()->json($event[0]->eventParticipants);
        }

        $totalEvent = Events::all()->count();
        $eventAktif = Events::where('event_date', '=', now()->toDateString())->where('event_start', '<', now())->where('event_end', '>', now())->get()->count();
        $eventSelesai = Events::where('event_date', '<=', now()->toDateString())->where('event_end', '<', now())->get()->count();
        $event = Events::all();
        $totalUser = User::all()->count();
        return view('dashboard', compact('totalEvent', 'totalUser', 'eventAktif', 'eventSelesai', 'event'));
    }

    public function joined(){
        $eventId = EventParticipants::has('event')->where('id_user', '=', Auth::id())->get();
        $event = Events::with('eventParticipants')->find($eventId);
        return view('home.joined', compact('event'));
    }


    public function Logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
    }
}
