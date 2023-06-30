<?php

declare(strict_types=1);

namespace OpenFintech\Security\Permission\Domain;

interface PermissionRepository
{
    public function save(Permission $permission): void;

    public function find(string $id): ?Permission;

    public function findAll(): array;

    public function remove(string $id): void;
}
