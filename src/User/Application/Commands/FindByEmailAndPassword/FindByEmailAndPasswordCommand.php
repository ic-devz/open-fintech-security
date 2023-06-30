<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\FindByEmailAndPassword;

use Security\Command\Domain\Command;

class FindByEmailAndPasswordCommand implements Command
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public function getName(): string
    {
        return "user.find_by_email_and_password";
    }

    public function getContext(): array
    {
        return [
            "email" => $this->email,
            "password" => $this->password,
        ];
    }

}
