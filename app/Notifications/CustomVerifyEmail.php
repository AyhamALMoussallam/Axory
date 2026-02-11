<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailBase
{
    /**
     * Generate the temporary signed verification URL.
     */
    protected function verificationUrl($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification())
            ]
        );

        // Here you can modify the URL to redirect to your frontend application
        return "http://your-frontend-domain.com/email/verify?url={$url}";
    }

    /**
     * Build the email message.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Verify Your Email Address')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line('Click the button below to verify your email address.')
                    ->action('Verify Email', $this->verificationUrl($notifiable))
                    ->line('If you did not create an account, no further action is required.');
    }
}
