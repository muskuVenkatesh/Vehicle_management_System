<?php

namespace App\Notifications\Channels;

use Twilio\Rest\Client;

class TwilioChannel
{
    public function send($notifiable, $notification)
    {
        $message = $notification->toTwilio($notifiable);

        if (!$message || !$notifiable->phone) {
            return;
        }

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        // Send SMS
        $twilio->messages->create($notifiable->phone, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => $message,
        ]);

        // Send WhatsApp Message
        $twilio->messages->create('whatsapp:' . $notifiable->phone, [
            'from' => env('TWILIO_WHATSAPP_NUMBER'),
            'body' => $message,
        ]);
    }
}
