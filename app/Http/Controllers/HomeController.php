<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\VerifyRole;
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
            return view('home.index');
        }
        return view('dashboard');
    }

    public function Logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
    }
}
