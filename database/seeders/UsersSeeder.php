<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // $users = [
        //     [
        //         'name' => 'Admin One',
        //         'email' => 'admin1@example.com',
        //         'password' => Hash::make('12345678'),
        //         'role' => 'admin',
        //         'no_telp' => '081234567890',
        //         'alamat' => 'Jl. Admin Satu No. 1',
        //         'email_verified_at' => Carbon::now(),
        //         'email_verification_expired_at' => Carbon::now()->addDays(1),
        //     ],
        //     [
        //         'name' => 'Admin Two',
        //         'email' => 'admin2@example.com',
        //         'password' => Hash::make('12345678'),
        //         'role' => 'admin',
        //         'no_telp' => '081234567891',
        //         'alamat' => 'Jl. Admin Dua No. 2',
        //         'email_verified_at' => Carbon::now(),
        //         'email_verification_expired_at' => Carbon::now()->addDays(1),
        //     ],
        //     [
        //         'name' => 'Admin Three',
        //         'email' => 'admin3@example.com',
        //         'password' => Hash::make('12345678'),
        //         'role' => 'admin',
        //         'no_telp' => '081234567892',
        //         'alamat' => 'Jl. Admin Tiga No. 3',
        //         'email_verified_at' => Carbon::now(),
        //         'email_verification_expired_at' => Carbon::now()->addDays(1),
        //     ],
        // ];

        // // Create 3 admin users
        // foreach ($users as $user) {
        //     User::create($user);
        // }

        // // Create 7 regular users
        // for ($i = 1; $i <= 7; $i++) {
        //     // Randomly decide if user is verified
        //     $isVerified = rand(0, 1);
        //     $verifiedAt = $isVerified ? Carbon::now()->subDays(rand(1, 30)) : null;
        //     $expirationAt = $verifiedAt ? Carbon::parse($verifiedAt)->addDays(1) : Carbon::now()->addDays(1);

        //     User::create([
        //         'name' => 'User ' . $i,
        //         'email' => 'user' . $i . '@example.com',
        //         'password' => Hash::make('12345678'),
        //         'role' => 'user',
        //         'no_telp' => '08' . rand(1000000000, 9999999999),
        //         'alamat' => 'Jl. User ' . $i . ' No. ' . $i,
        //         'email_verified_at' => $verifiedAt,
        //         'email_verification_expired_at' => $expirationAt,
        //     ]);
        // }

         User::create([
                'name' => 'Juguran Komunitas',
                'email' => 'admin@jugurankomunitas.id',
                'password' => Hash::make('adminnemo1945'),
                'role' => 'admin',
                'no_telp' => null,
                'alamat' => 'Jl. Yudistira No.12, Dusun 2, Pandak, Kec. Baturaden, Kabupaten Banyumas, Jawa Tengah 53151',
                'email_verified_at' => Carbon::now(),
                'email_verification_expired_at' => Carbon::now(),
            ]);
    }
}
