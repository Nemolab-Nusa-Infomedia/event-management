<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    User::whereNull('email_verified_at')->where('email_verification_expired_at', '<', now())->delete();
})->everyMinute();
Schedule::command('cache:clear')->everyTenMinutes();
