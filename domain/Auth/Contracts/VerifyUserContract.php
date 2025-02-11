<?php

namespace App\Contracts;

use App\DTOs\VerifyUserDTO;

interface VerifyUserContract
{
    /**
     * Executa o processo de verificação do usuário.
     *
     * @param VerifyUserDTO $dto
     * @return bool
     * @throws \Exception Em caso de código inválido ou usuário não encontrado.
     */
    public function exec(VerifyUserDTO $dto): bool;
}
