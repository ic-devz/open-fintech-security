<?php

declare(strict_types=1);

namespace Security\User\Application\Commands\UpdateUser;

use Security\Command\Domain\Command;
use Security\Command\Domain\CommandHandler;
use Security\User\Domain\PasswordEncrypt;
use Security\User\Domain\User;
use Security\User\Domain\UserException;
use Security\User\Domain\UserRepository;

class UpdateUserHandler implements CommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordEncrypt $passwordEncrypt,
    ) {
    }


    public function listenTo(): string
    {
        return UpdateUserCommand::class;
    }

    /**
     * @param UpdateUserCommand $command
     * @return mixed
     * @throws UserException
     */
    public function handle(Command $command): mixed
    {
        $userFind = $this->userRepository->findByEmail($command->email);
        if ($userFind) {
            throw new UserException('User already exists');
        }

        return $this->userRepository->update(
            $command->id,
            new User(
                null,
                $command->name,
                $command->email,
                $this->passwordEncrypt->encrypt($command->password),
                $command->twoFactorSecret,
                $command->twoFactorEnabled,
                $command->role,
                $command->permissions,
                $command->emailConfirmAt,
                new \DateTimeImmutable(),
                new \DateTimeImmutable(),
            )
        );
    }
}
