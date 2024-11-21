<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $event = [];
    public $user = [];
    public $participant_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $user, $participant_id)
    {
        $this->event = $event;
        $this->user = $user;
        $this->participant_id = $participant_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $qrCode = QrCode::format('svg')->size(256)->generate(route('participan.verification', $this->participant_id));
        $qrCodeBase64 = base64_encode($qrCode);

        return $this->subject('Event Joined - ' . $this->event['name'])
            ->view('mails.eventJoined')
            ->with([
                'event' => $this->event,
                'user' => $this->user,
                'participant_id' => $this->participant_id,
            ])
            ->attachData(base64_decode($qrCodeBase64), 'qrcode.svg', [
                'mime' => 'image/svg+xml',
            ]);
    }
}
