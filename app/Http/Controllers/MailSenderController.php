<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Mail\EventJoined;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailSenderController extends Controller
{

    public static function SendNotif($request, $participant)
    {
        $event = Events::findOrFail($request['id_event']);

        if ($event) {
            Mail::to($request['email'])->send(new EventJoined($event, $request, $participant));
        }
    }
}
