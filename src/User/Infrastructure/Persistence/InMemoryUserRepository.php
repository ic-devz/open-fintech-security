<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Infrastructure\Persistence;

use OpenFintech\Security\User\Domain\User;
use OpenFintech\Security\User\Domain\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    public function save(User $user): User
    {
        return $user;
    }

    public function findById(string $id): ?User
    {
        return User::fake();
    }

    public function findByEmail(string $email): ?User
    {
        return User::fake();
    }

    public function update(string $id, User $user): User
    {
        return $user;
    }

    public function delete(User $user): bool
    {
        return true;
    }
}
