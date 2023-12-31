<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterVerify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build(){
        return $this
            ->subject('Thank you for subscribing to our newsletter')
            ->markdown('emails.subscribers');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Register Verify',
            from: new Address('frozenaircond.noreply@gmail.com', 'Frozen Aircond Sdn Bhd'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url = route('service.email.activate', [
            'email' => $this->user->email,
            'token' => strtotime($this->user->created_at),
        ]);

        return new Content(
            markdown: 'emails.register.verify',
            with: [
                'name' => $this->user->name,
                'url' => urldecode($url) ,
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
        return [];
    }
}
