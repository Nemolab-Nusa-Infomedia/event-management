<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define the admin-only gate
        Gate::define('admin-only', function ($user) {
            return $user->role === 'admin';
        });

        $this->app['events']->listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            // Get authenticated user
            $user = Auth::user();
            
            // Get events based on user role
            $events = $user->role === 'admin' 
                ? Events::all() 
                : Events::where('user_id', $user->id)->get();
            
            // Only add submenu if there are events
            if ($events->isNotEmpty()) {
                $event->menu->add([
                    'text' => 'Participants',
                    'url' => '',
                    'icon' => 'fas fa-users',
                    'submenu' => $events->map(function ($event) {
                        return [
                            'text' => $event->name,
                            'url' => 'admin/event/' . $event->id,
                            'icon' => 'far fa-circle',
                        ];
                    })->toArray()
                ]);
            }
        });
    }
}