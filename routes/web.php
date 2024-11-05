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

Route::get('/login', function () {
    return view('./login/signin');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::resource('/admin/user',  UsersController::class)->middleware('auth');

// Route::resource('/admin',  Route::has('/user') ? UsersController::class : (Route::has('/eventParticipan') ? EventParticipantsController::class : (Route::has('/event') ? EventsController::class : AdminController::class)))->middleware('auth');
// Route::resource('/admin/eventParticipan', EventParticipants::class)->middleware('auth');
// Route::resource('/admin/event', EventsController::class)->middleware('auth');
