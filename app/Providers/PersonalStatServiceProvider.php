<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Events;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PersonalStatServiceProvider extends ServiceProvider
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
                $eventJoined = EventParticipants::where('id_user', $user->id)->get()->count();
                $eventCreated = Events::where('id_master', $user->id)->get()->count();
                $totalParticipant = EventParticipants::with(['user', 'event'])
                    ->whereHas('event', function ($query) {
                        $query->where('id_master', Auth::id());
                    })
                    ->get()->count();
                $view->with('eventJoined', $eventJoined);
                $view->with('eventCreated', $eventCreated);
                $view->with('totalParticipant', $totalParticipant);
            } else {
                $view->with('eventJoined', collect([]));
            }
        });
    }
}
