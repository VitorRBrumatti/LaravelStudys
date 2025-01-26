<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Domain\Shared\Helpers\APIResponse;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
  public function exec() : JsonResponse
  {
    return APIResponse::success('test');
  }
}