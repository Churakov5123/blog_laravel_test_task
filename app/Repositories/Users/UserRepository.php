<?php
declare(strict_types=1);

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для работы с пользователями.
 *
 * Class UserRepository
 * @package App\Repositories\Users
 */
class UserRepository
{
    /**
     * Получить всех пользователей.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return User::select()->get()->sort();
    }
}
