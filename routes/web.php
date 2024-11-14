<?php

use Illuminate\Http\Request;
use App\Models\EventParticipants;
use PHPUnit\Event\EventCollection;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\VerifyRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Middleware\VerificationEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventParticipantsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/home/logout', [HomeController::class, 'logout'])->name('home.logout');;
Route::get('/change-email', function () {
    return view('auth.register');
})->name('change.email');
Route::put('/change-email', [UsersController::class, 'update'])->name('change.email');

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.email');

// Rute untuk menampilkan halaman verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Rute untuk memverifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home'); // Ganti '/home' dengan rute tujuan setelah verifikasi
})->middleware(['auth', 'signed'])->name('verification.verify');

// Rute untuk mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(VerificationEmail::class)->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('admin/')->middleware(['auth', AdminCheck::class])->group(function () {
        Route::resource('user', UsersController::class);
        Route::resource('eventParticipan', EventParticipantsController::class);
        Route::resource('event', EventsController::class);
    });

    Route::resource('eventParticipan', EventParticipantsController::class);

    Route::resource('event', EventsController::class);

    Route::get('admin/event/{event}/edit', [EventsController::class, 'edit'])->name('event.edit');

    Route::post('/join', [EventParticipantsController::class, 'store'])->name('join');
    Route::get('/joined', [HomeController::class, 'joined'])->name('joined');
    // Route::get('/joined', [HomeController::class, 'joined'])->name('joined');
    Route::post('/update-status/{event}', [HomeController::class, 'updateStatus'])->name('update.status');
});
