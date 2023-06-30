<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\UpdateUser;

use OpenFintech\Security\Command\Domain\Command;
use OpenFintech\Security\Role\Domain\Role;

class UpdateUserCommand implements Command
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly Role $role,
        public readonly array $permissions,
        public readonly ?string $twoFactorSecret,
        public readonly bool $twoFactorEnabled,
        public readonly ?\DateTimeImmutable $emailConfirmAt,
    ) {
    }

    public function getName(): string
    {
        return "user.update";
    }

    public function getContext(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'permissions' => $this->permissions,
            'twoFactorSecret' => $this->twoFactorSecret,
            'twoFactorEnabled' => $this->twoFactorEnabled,
            'emailConfirmAt' => $this->emailConfirmAt,
        ];
    }
}
