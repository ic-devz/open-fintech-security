<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application\Commands\FindByEmailAndPassword;

use OpenFintech\Security\Command\Domain\Command;
use OpenFintech\Security\Command\Domain\CommandHandler;
use OpenFintech\Security\User\Domain\PasswordEncrypt;
use OpenFintech\Security\User\Domain\UserRepository;

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
