<?php

namespace App\Services;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendWelcomeEmail($user)
    {
        // Envia e-mail de boas-vindas
        Mail::to($user->email)->send(new WelcomeEmail($user));
    }
}