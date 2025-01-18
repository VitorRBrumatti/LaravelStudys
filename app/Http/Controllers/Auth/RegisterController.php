<?php

namespace App\Http\Controllers\Auth;

use App\Domain\DTOs\UserDTO;
use App\Domain\Jobs\SendWelcomeEmailJob;
use App\Domain\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Criação do DTO
        $userDTO = new UserDTO($validated['name'], $validated['email']);

        // Registra o usuário e dispara o Job para enviar o e-mail
        $user = $this->userService->registerUser($userDTO);
        SendWelcomeEmailJob::dispatch($userDTO);

        return response()->json(['message' => 'Cadastro realizado com sucesso!'], 201);
    }
}
