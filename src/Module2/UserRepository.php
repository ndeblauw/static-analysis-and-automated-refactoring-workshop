<?php
declare(strict_types=1);

namespace App\Module2;

final class UserRepository
{
    private $users;

    public function getById(int $userId): User
    {
        if (isset($this->users[$userId])) {
            return $this->users[$userId];
        }

        throw new \RuntimeException('User not found');
    }

    public function save(int $id, User $user): void
    {
        $this->users[$id] = $user;
    }
}
