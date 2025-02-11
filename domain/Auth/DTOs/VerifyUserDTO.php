<?php

declare(strict_types=1);

namespace Domain\Auth\DTOs;

class VerifyUserDTO
{
    public function __construct(
        public string $email,
        public int $codigo
    ) {}
}
