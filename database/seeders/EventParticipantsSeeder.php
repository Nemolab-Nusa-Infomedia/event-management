<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventParticipants;
use App\Models\Events;

class EventParticipantsSeeder extends Seeder
{
    public function run(): void
    {
        $events = Events::all();
        $userIds = range(1, 10);
        $participantIds = range(1, 10);
        $statuses = ['Present', 'Absent'];

        foreach ($events as $event) {
            // For each event, create 3-7 participants
            $numParticipants = rand(3, 7);
            
            for ($i = 0; $i < $numParticipants; $i++) {
                // Randomly decide whether to use user_id or participant_id
                $useUser = (bool)rand(0, 1);
                
                EventParticipants::create([
                    'id_user' => $useUser ? $userIds[array_rand($userIds)] : null,
                    'id_participant' => !$useUser ? $participantIds[array_rand($participantIds)] : null,
                    'id_event' => $event->id,
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}