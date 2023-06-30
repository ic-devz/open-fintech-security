<?php

declare(strict_types=1);

namespace Security\Role\Domain;

interface RoleRepository
{
    public function save(Role $role): void;

    public function find(string $id): ?Role;

    public function findAll(): array;

    public function remove(Role $role): void;
}
