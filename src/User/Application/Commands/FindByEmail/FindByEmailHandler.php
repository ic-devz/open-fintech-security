<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\FindByEmail;

use OpenFintech\Security\Command\Domain\Command;
use OpenFintech\Security\Command\Domain\CommandHandler;
use OpenFintech\Security\User\Domain\UserRepository;

class FindByEmailHandler implements CommandHandler
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function listenTo(): string
    {
        return FindByEmailCommand::class;
    }

    /**
     * @param FindByEmailCommand $command
     * @return mixed
     */
    public function handle(Command $command): mixed
    {
        return $this->userRepository->findByEmail($command->email);
    }
}
