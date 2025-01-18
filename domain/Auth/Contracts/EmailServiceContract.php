<?php

namespace App\Domain\Contracts;

interface EmailServiceContract
{
    public function sendWelcomeEmail($userDTO): void;
}