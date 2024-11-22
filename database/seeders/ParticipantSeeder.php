<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participants;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Participants::create([
                'name' => 'Participant ' . $i,
                'email' => 'participant' . $i . '@example.com',
                'no_telp' => '08' . rand(1000000000, 9999999999),
                'alamat' => 'Jl. Participant ' . $i . ' No. ' . $i,
            ]);
        }
    }
}