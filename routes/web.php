<?php

use App\Http\Controllers\Controller;
use App\Models\EventParticipants;
use PHPUnit\Event\EventCollection;
use App\Http\Middleware\VerifyRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventParticipantsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Middleware\VerificationEmail;

Route::get('/login', function () {
    return view('./login/signin');
});

Route::post('/home/logout', [HomeController::class, 'logout'])->name('home.logout');

Route::get('/register', [UsersController::class, 'create'])->name('register');
Route::post('/register', [UsersController::class, 'store']);

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
    return view('welcome');
});

Auth::routes();

Route::middleware(VerificationEmail::class)->group(function(){
 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    
    Route::middleware('auth')->group(function () {
        Route::resource('/admin/user', UsersController::class);
        Route::resource('/admin/eventParticipan', EventParticipantsController::class);
        Route::resource('/admin/event', EventsController::class);
        // Route::resource('/admin', AdminController::class);
    });
    
    Route::get('admin/event/{event}/edit', [EventsController::class, 'edit'])->name('event.edit');
    
});