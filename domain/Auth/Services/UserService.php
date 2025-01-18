<?php

namespace App\Domain\Services;

use App\Domain\Contracts\EmailServiceContract;
use App\Domain\DTOs\UserDTO;
use App\Domain\Repositories\UserRepository;
use App\Models\User;

class UserService
{
    private UserRepository $userRepository;
    private EmailServiceContract $emailService;

    public function __construct(UserRepository $userRepository, EmailServiceContract $emailService)
    {
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
    }

    public function registerUser(UserDTO $userDTO): User
    {
        // Cria o usuário no banco
        $user = $this->userRepository->createUser($userDTO);

        // Dispara o e-mail de boas-vindas
        $this->emailService->sendWelcomeEmail($userDTO);

        return $user;
    }
}
