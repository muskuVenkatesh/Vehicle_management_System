<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // $this->verificationUrl = URL::temporarySignedRoute(
        //     'login.verify',
        //     Carbon::now()->addMinutes(60),
        //     // ['id' => $this->user->id]
        // );
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Login Verification Mail',
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
            view: 'email.login_success',
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



public function build()
    {
        return $this->subject('Verify Your Login')
                    ->view('emails.login_success')
                    ->with(['verificationUrl' => route('login.verify', $this->user->login_verification_token)]);
    }

}
