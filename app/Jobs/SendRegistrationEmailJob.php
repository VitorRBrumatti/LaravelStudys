<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Domain\Auth\DTOs\RegisterUserDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmailJob implements ShouldQueue  
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;  

    protected $user;
    protected $codigo;

    public function __construct(RegisterUserDTO $user, $codigo)
    {
        $this->user = $user;
        $this->codigo = $codigo;
    }

    public function handle()
    {
        try {
            Log::info('Iniciando envio de email de boas-vindas para o usuário: ' . $this->user->email);

            $userModel = User::where('email', $this->user->email)->first();  

            if ($userModel) {
                Mail::to($userModel->email)->send(new WelcomeEmail($userModel, $this->codigo));

                Log::info('Email de boas-vindas enviado com sucesso para: ' . $userModel->email);
            } else {
                Log::error('Usuário não encontrado para o e-mail: ' . $this->user->email);
            }

        } catch (\Exception $e) {
            Log::error('Erro ao enviar email de boas-vindas para o usuário: ' . $this->user->email, [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }
}
