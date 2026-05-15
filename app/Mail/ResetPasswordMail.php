<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public User   $user;
    public string $otp;

    /**
     * @param User   $user
     * @param string $otp   6-digit plain-text OTP (never stored plain, only hashed in DB)
     */
    public function __construct(User $user, string $otp)
    {
        $this->user = $user;
        $this->otp  = $otp;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Your Password — ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}