<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $eventName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventName)
    {
        $this->eventName = $eventName;
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
                        'eventName' => $this->eventName,
                    ]);
    }
}
