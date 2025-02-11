<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class WelcomeEmail extends Mailable
{
    public User $user;
    public $codigo;

    public function __construct(User $user, $codigo)
    {
        $this->user = $user;
        $this->codigo = $codigo;
    }

    public function build()
    {
        return $this->view('emails.two-way-factor')
                    ->with([
                        'user' => $this->user,
                        'codigo' => $this->codigo, 
                    ]);
    }
}
