<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MySendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $client_name;
    public $client_subject;
    public $client_description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $name, $subject, $description)
    {
        $this->client_name = $name;
        $this->client_subject = $subject;
        $this->client_description = $description;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->client_subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.test_html',
            with: ['name' => $this->client_name],
        );
        
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
