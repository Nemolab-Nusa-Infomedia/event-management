<?php

namespace App\Providers;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $user = Auth::user();
        $myEvents = $user->role == 'admin' ? Events::all() : Events::where('id_master', '=', Auth::id())->orderBy('created_at', 'desc')->get();
        View::share('myEvents', $myEvents);
    }
}
