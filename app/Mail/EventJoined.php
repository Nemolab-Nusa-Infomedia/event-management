<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $event = [];
    public $user = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Event Joined')
                    ->view('mails.eventJoined')
                    ->with([
                        'event' => $this->event,
                        'user' => $this->user
                    ]);
    }
}
