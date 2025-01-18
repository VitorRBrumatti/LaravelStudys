<?php

namespace App\Domain\Jobs;

use App\Domain\DTOs\UserDTO;
use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
      public UserDTO $userDTO
    ){}

    public function handle()
    {
        Mail::to($this->userDTO->email)->send(new WelcomeEmail($this->userDTO));
    }
}
