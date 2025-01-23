<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTOs\RegisterUserDTO;
use Domain\Shared\Helpers\APIResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  public function __construct(
    protected readonly RegisterUserContract $registerUserContract
  ){}

  public function exec(Request $request) : JsonResponse
  {
    try {
      $validation = Validator::make($request->input(), [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'cellphone' => 'required|number',
        'password' => 'required|string|confirmed',
      ]);


      if($validation->fails()){
          return APIResponse::unprocessableEntity($validation->errors());
      }

      return APIResponse::success($this->registerUserContract->exec(new RegisterUserDTO(
        name: $request->input('name'),
        email: $request->input('email'),
        cellphone: $request->input('cellphone'),
        password: $request->input('password'),
      )));

    } catch (\Exception $e) {
      Log::error(__CLASS__, [
        'message'       => $e->getMessage(),
        'trace'         => $e->getTrace()
      ]);

      return APIResponse::internalServerError([
        'error' => 'error to register user'
      ]);
    }
  }
}