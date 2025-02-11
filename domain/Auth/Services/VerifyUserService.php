<?php

namespace App\Services;

use App\Contracts\VerifyUserContract;
use App\DTOs\VerifyUserDTO;
use Domain\Auth\Repositories\UserRepository;
use Illuminate\Support\Facades\Redis;
use Exception;

class VerifyUserService implements VerifyUserContract
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
         $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function exec(VerifyUserDTO $dto): bool
    {
      $key = "two-factor:{$dto->email}"; 
      $storedCode = Redis::get($key);

      if (!$storedCode || $storedCode != $dto->codigo) {
          throw new Exception("Código de verificação inválido ou expirado.");
      }

      $user = $this->userRepository->findByEmail($dto->email);
      if (!$user) {
          throw new Exception("Usuário não encontrado.");
      }

      $this->userRepository->markAsVerified($user);

      Redis::del('two-way-key');

      return true;
    }
}
