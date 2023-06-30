<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\FindByEmail;

use OpenFintech\Security\Command\Domain\Command;

class FindByEmailCommand implements Command
{
    public function __construct(
        public readonly string $email,
    ) {
    }

    public function getName(): string
    {
        return "user.find_by_email";
    }

    public function getContext(): array
    {
        return [
            "email" => $this->email,
        ];
    }
}
