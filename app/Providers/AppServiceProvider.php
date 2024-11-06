<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Events;

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
        $this->app['events']->listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $events = Events::all();
            
            $event->menu->add([
                'text' => 'Participants',
                'url' => 'admin/eventParticipan',
                'icon' => 'fas fa-users',
                'submenu' => $events->map(function ($event) {
                    return [
                        'text' => $event->name,
                        'url' => 'admin/eventParticipan/' . $event->id,
                        'icon' => 'far fa-circle',
                    ];
                })->toArray()
            ]);
        });
    }
}
