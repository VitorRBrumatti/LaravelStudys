<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bem-vindo ao sistema!')
            ->line('Olá, ' . $this->user->name . '!')
            ->line('Seu cadastro foi realizado com sucesso.')
            ->action('Acesse o sistema', url('/'))
            ->line('Obrigado por se cadastrar!');
    }
}
