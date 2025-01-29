<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly array $user)
    {
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            from:new Address('CantinhoDaJosi@example.com', 'Cantinho da Josi'),
            subject: 'Welcome Mail'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function headers()    
    {
        return [
            'X-Custom-Header' => 'Custom Value',
        ];
    }

    public function build()
    {
        return $this->view('emails.welcome');
    }
}