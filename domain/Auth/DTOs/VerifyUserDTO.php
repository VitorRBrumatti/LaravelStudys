<?php

namespace App\DTOs;

class VerifyUserDTO
{
    public function __construct(
        public string $email,
        public int $codigo
    ) {}
}
