<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\FindById;

use OpenFintech\Security\Command\Domain\Command;

class FindByIdCommand implements Command
{
    public function __construct(
        public readonly string $id,
    ) {
    }


    public function getName(): string
    {
        return "user.find_by_id";
    }

    public function getContext(): array
    {
        return [
            "id" => $this->id,
        ];
    }
}
