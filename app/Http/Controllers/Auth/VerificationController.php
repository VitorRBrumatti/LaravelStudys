<?php

namespace App\Http\Controllers\Auth;

use Domain\Auth\Contracts\VerifyUserContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Auth\DTOs\VerifyUserDTO;
use Domain\Shared\Helpers\APIResponse;

class VerificationController extends Controller
{
    protected VerifyUserContract $verifyUserContract;

    public function __construct(VerifyUserContract $verifyUserContract)
    {
      $this->verifyUserContract = $verifyUserContract;
    }

    /**
     * Endpoint para verificação do código.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
      $request->validate([
        'email'  => 'required|email',
        'codigo' => 'required|integer'
      ]);

      $dto = new VerifyUserDTO(
        email: $request->input('email'),
        codigo: (int)$request->input('codigo')
      );

      try {
        $this->verifyUserContract->exec($dto);
        return APIResponse::success(['message' => 'Usuário verificado com sucesso.']);
      } catch (\Exception $e) {
        return APIResponse::internalServerError(['message' => $e->getMessage()], 422);
      }
    }
}
