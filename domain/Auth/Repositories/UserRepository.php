<?php

declare(strict_types=1);

namespace Domain\Auth\Repositories;

use App\Models\User;
use Domain\Auth\Contracts\UserRepositoryContract;
use Domain\Shared\Repositories\BaseRepository;
class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct()
    {
        $this->modelClass = User::class;
        parent::__construct();
    }

        /**
     * Busca um usuário pelo e-mail.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Marca o usuário como verificado.
     */
    public function markAsVerified(User $user): bool
    {
        $user->email_verified_at = now();
        return $user->save();
    }

}
