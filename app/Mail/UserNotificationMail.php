<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $notificationMessage; // Renamed variable

    public function __construct($user, $notificationMessage)
    {
        $this->user = $user;
        $this->notificationMessage = $notificationMessage; // Updated variable name
    }

    public function build()
    {
        return $this->subject('Admin Notification')
                    ->view('email.user_notification')
                    ->with([
                        'user' => $this->user,
                        'message' => $this->notificationMessage, // Updated variable name
                    ]);
    }
}
