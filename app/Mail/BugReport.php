<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class BugReport extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $datetime;
    public $screenshot;
    public $description;
    public $additional;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->email = $data->email;
        $this->datetime = $data->datetime;
        $this->description = $data->description;
        $this->additional = $data->additional;

        $this->screenshot = $data->screenshot->getPathName();
    }

    public function build(){
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Report Bugs',
            from: new Address('frozenaircond.noreply@gmail.com', 'Frozen Aircond Sdn Bhd'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
    
        return new Content(

            view: 'emails.bug.report',
            with: [
                'email' => $this->email,
                'datetime' => $this->datetime,
                'screenshot ' => $this->screenshot,
                'description' => $this->description,
                'additional' => $this->additional,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [

        ];
    }
}
