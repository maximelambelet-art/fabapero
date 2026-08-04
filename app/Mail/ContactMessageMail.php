<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $senderName,
        public readonly string $senderEmail,
        public readonly string $messageBody,
    ) {}

    public function build(): self
    {
        return $this
            ->subject(__('contact.subject'))
            ->replyTo($this->senderEmail, $this->senderName)
            ->view('emails.contact');
    }
}
