<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificateMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $eventParticipan;
    public $name;
    public $pdfContent;

    /**
     * Create a new message instance.
     *
     * @param $eventParticipan
     * @param $name
     * @param $pdfContent
     */
    public function __construct($eventParticipan, $name, $pdfContent)
    {
        $this->eventParticipan = $eventParticipan;
        $this->name = $name;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfUrl = url('certificates/'.str_replace(' ', '', $this->name).'_certificate.pdf');
        return $this->view('event.certificate.mail')
                    ->subject('Sertifikat Juguran Komunitas')
                    ->with([
                        'pdfUrl' => $pdfUrl,
                    ]);
    }
}

