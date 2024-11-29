<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomPasswordReset extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', ['token' => $this->token], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->greeting('Bonjour !')
            ->line('Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte sur ' . env('APP_NAME'))
            ->action('Réinitialiser le mot de passe', $url)
            ->line("Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action n'est requise.");
    }
}
