<?php

namespace App\Domain\Services;

use App\Domain\Contracts\EmailServiceContract;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailService implements EmailServiceContract
{
    public function sendWelcomeEmail($userDTO): void
    {
        // Envia o e-mail de boas-vindas
        Mail::to($userDTO->email)->send(new WelcomeEmail($userDTO));
    }
}
