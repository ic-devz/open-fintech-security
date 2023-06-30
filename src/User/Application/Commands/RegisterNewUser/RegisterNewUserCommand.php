<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\RegisterNewUser;

use Security\Command\Domain\Command;
use Security\Role\Domain\Role;

class RegisterNewUserCommand implements Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly Role $role,
    ) {
    }

    public function getName(): string
    {
        return "user.register";
    }

    public function getContext(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }
}
