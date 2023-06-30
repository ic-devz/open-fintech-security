<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\FindByEmail;

use Security\Command\Domain\Command;
use Security\Command\Domain\CommandHandler;
use Security\User\Domain\UserRepository;

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
