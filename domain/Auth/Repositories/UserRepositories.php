<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\UserDTO;

interface UserRepository
{
    public function createUser(UserDTO $userDTO): \App\Models\User;
}
