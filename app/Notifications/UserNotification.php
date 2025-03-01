<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\UserNotificationMail;
use App\Notifications\Channels\TwilioChannel;
use Illuminate\Support\Facades\Mail;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $message;

    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail', TwilioChannel::class];
    }

    public function toMail($notifiable)
    {
        return new UserNotificationMail($this->user, $this->message);
    }

    public function toTwilio($notifiable)
    {
        return "Hello {$this->user->name}, {$this->message}";
    }
}
