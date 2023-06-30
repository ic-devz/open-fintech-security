<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\RegisterNewUser;

use Security\Command\Domain\Command;
use Security\Command\Domain\CommandHandler;
use Security\User\Domain\PasswordEncrypt;
use Security\User\Domain\User;
use Security\User\Domain\UserException;
use Security\User\Domain\UserRepository;

class RegisterNewUserHandler implements CommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordEncrypt $passwordEncrypt,
    ) {
    }

    public function listenTo(): string
    {
        return RegisterNewUserCommand::class;
    }

    /**
     * @param RegisterNewUserCommand $command
     * @return mixed
     * @throws UserException
     */
    public function handle(Command $command): mixed
    {
        $userFind = $this->userRepository->findByEmail($command->email);
        if ($userFind) {
            throw new UserException('User already exists');
        }

        return $this->userRepository->save(
            new User(
                null,
                $command->name,
                $command->email,
                $this->passwordEncrypt->encrypt($command->password),
                null,
                false,
                $command->role,
                [],
                null,
                new \DateTimeImmutable(),
                new \DateTimeImmutable(),
            )
        );
    }
}
