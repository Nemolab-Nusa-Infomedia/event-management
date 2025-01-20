<?php

namespace App\Mail;

use Illuminate\Support\Str;
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
        $randomString = Str::random(10);
        $qrCode = QrCode::format('png')->size(300)->generate($this->participant_id);
        $qrCodePath = public_path('qrcodes/' . $this->participant_id.'-' . $randomString . '.png');
        file_put_contents($qrCodePath, $qrCode);

        return $this->subject('Event Joined - ' . $this->event['name'])
            ->view('mails.eventJoined')
            ->with([
                'event' => $this->event,
                'user' => $this->user,
                'participant_id' => $this->participant_id,
                'qrCodePath' => $qrCodePath
            ]);
    }
}
