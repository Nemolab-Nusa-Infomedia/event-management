<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Events;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $adminIds = \App\Models\User::where('role', 'admin')->pluck('id')->toArray();
        
        for ($i = 1; $i <= 50; $i++) {
            $startDate = Carbon::now()->addDays(rand(1, 180));
            $startTime = sprintf("%02d:%02d:00", rand(8, 20), rand(0, 59));
            $endTime = Carbon::parse($startTime)->addHours(rand(1, 4))->format('H:i:s');

            Events::create([
                'id_master' => $adminIds[array_rand($adminIds)],
                'user_id' => rand(1, 10),
                'name' => 'Event ' . $i,
                'event_date' => $startDate->format('Y-m-d'),
                'event_start' => $startTime,
                'event_end' => $endTime,
                'location' => 'Location ' . $i,
                'thumbnail_img' => 'event-thumbnails/1M14x81Hk9Vu8hq784Hgys8Dy8vcXmlWmgES08IR.jpg',
                'about' => 'About event ' . $i,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}