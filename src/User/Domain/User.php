<?php

declare(strict_types=1);

namespace Security\User\Domain;

use Security\Permission\Domain\Permission;
use Security\Role\Domain\Role;

class User
{
    /**
     * @param string|null $id
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string|null $twoFactorSecret
     * @param bool $twoFactorEnabled
     * @param Role $role
     * @param Permission[] $permissions
     * @param \DateTimeImmutable|null $emailConfirmAt
     * @param \DateTimeImmutable $createdAt
     * @param \DateTimeImmutable $updatedAt
     */
    public function __construct(
        public readonly ?string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $twoFactorSecret,
        public readonly bool $twoFactorEnabled,
        public readonly Role $role,
        public readonly array $permissions,
        public readonly ?\DateTimeImmutable $emailConfirmAt,
        public readonly \DateTimeImmutable $createdAt,
        public readonly \DateTimeImmutable $updatedAt,
    ) {
    }

    public static function fake(): static
    {
        return new static(
            "1",
            "John Doe",
            "jonhdoe@example.io",
            "password_encrypted",
            "two_factor_secret",
            true,
            new Role("1", "user", "User", new \DateTimeImmutable(), new \DateTimeImmutable()),
            [
                new Permission(
                    "1",
                    "user.find_by_email",
                    "Create user",
                    new \DateTimeImmutable(),
                    new \DateTimeImmutable(),
                )
            ],
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
        );
    }

    public function hasPermission(string $permissionName): bool
    {
        foreach ($this->permissions as $permission) {
            if ($permission->name === $permissionName) {
                return true;
            }
        }

        return false;
    }
}
