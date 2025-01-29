<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Domain\Auth\DTOs\RegisterUserDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmailJob implements ShouldQueue  
{
    use Dispatchable, Queueable, SerializesModels;  

    protected object $registerUserDTO;

    public function __construct(RegisterUserDTO $registerUserDTO)
    {
        $this->registerUserDTO = $registerUserDTO;
    }

    public function handle()
    {
        try {
            Mail::to($this->registerUserDTO->email)->send(new WelcomeEmail($this->registerUserDTO));
        } catch (\Exception $e) {
            logger()->error("Falha no envio do email: " . $e->getMessage(), [
                'email' => $this->registerUserDTO->email,
                'exception' => $e,
                'stack_trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
