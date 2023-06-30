<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\FindByEmailAndPassword;

use Security\Command\Domain\Command;
use Security\Command\Domain\CommandHandler;
use Security\User\Domain\PasswordEncrypt;
use Security\User\Domain\UserRepository;

class FindByEmailAndPasswordHandler implements CommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordEncrypt $passwordEncrypt,
    ) {
    }

    public function listenTo(): string
    {
        return FindByEmailAndPasswordCommand::class;
    }

    /**
     * @param FindByEmailAndPasswordCommand $command
     * @return mixed
     */
    public function handle(Command $command): mixed
    {
        $user = $this->userRepository->findByEmail($command->email);
        if (!$user) {
            return null;
        }

        if (!$this->passwordEncrypt->verify($command->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
