<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Mail\EventJoined;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailSenderController extends Controller
{

public static function SendNotif(Request $request)
{
    $user = Auth::user();
    $event = Events::where('id', '=', $request->id_event)->get('name');
    Mail::to($user->email)->send(new EventJoined($event[0], $user));
}

}
