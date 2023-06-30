<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\DeleteUser;

use OpenFintech\Security\Command\Domain\Command;

class DeleteUserCommand implements Command
{
    public function __construct(
        public readonly string $id,
    ) {
    }

    public function getName(): string
    {
        return "user.delete";
    }

    public function getContext(): array
    {
        return [
            "id" => $this->id,
        ];
    }
}
