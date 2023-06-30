<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Domain;

interface UserRepository
{
    public function save(User $user): User;
    public function findById(string $id): ?User;
    public function findByEmail(string $email): ?User;
    public function update(string $id, User $user): User;
    public function delete(User $user): bool;
}
