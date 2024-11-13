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
        View::composer('*', function ($view) {
            // Get authenticated user
            $user = Auth::user();
            
            // Only proceed if user is authenticated
            if ($user) {
                // Get events based on user role
                $myEvents = $user->role === 'admin'
                    ? Events::all()
                    : Events::where('id_master', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
                
                $view->with('myEvents', $myEvents);
            } else {
                $view->with('myEvents', collect([]));
            }
        });
    }
}