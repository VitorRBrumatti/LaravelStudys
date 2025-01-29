<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendRegistrationEmailJob;
use App\Mail\WelcomeEmail;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTOs\RegisterUserDTO;
use Domain\Shared\Helpers\APIResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        'cellphone' => 'required|numeric',
        'password' => 'required|string',
      ]);

      if($validation->fails()){
        return APIResponse::unprocessableEntity($validation->errors());
      }

      $user = new RegisterUserDTO(
        name: $request->input('name'),
        email: $request->input('email'),
        cellphone: $request->input('cellphone'),
        password: $request->input('password'),
      );

      $this->registerUserContract->exec($user);

      SendRegistrationEmailJob::dispatch($user);
      // Mail::to($user->email)->send(new WelcomeEmail([
      //   'name' => $user->name,
      //   'email' => $user->email,
      //   'cellphone' => $user->cellphone,
      //   'password' => $user->password
      // ]));

      return APIResponse::success('User registered successfully.');

    } catch (\Exception $e) {
      Log::error('Error in user registration', [
        'message' => $e->getMessage(),
        'trace' => $e->getTrace(),
        'request_data' => $request->all()
      ]);

      // Retorne uma resposta JSON com erro
      return response()->json([
        'status' => 'ERROR',
        'message' => 'An error occurred during registration.',
        'error_details' => $e->getMessage()
      ], 500);
    }
  }
}