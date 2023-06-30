<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Application;

use OpenFintech\Security\Command\Domain\CommandBus;
use OpenFintech\Security\Role\Domain\Role;
use OpenFintech\Security\User\Application\Commands\DeleteUser\DeleteUserCommand;
use OpenFintech\Security\User\Application\Commands\FindByEmail\FindByEmailCommand;
use OpenFintech\Security\User\Application\Commands\FindByEmailAndPassword\FindByEmailAndPasswordCommand;
use OpenFintech\Security\User\Application\Commands\FindById\FindByIdCommand;
use OpenFintech\Security\User\Application\Commands\RegisterNewUser\RegisterNewUserCommand;
use OpenFintech\Security\User\Application\Commands\UpdateUser\UpdateUserCommand;
use OpenFintech\Security\User\Domain\User;

class UserService
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @param Role $role
     * @param User $userAuthorized
     * @return User
     * @throws \Throwable
     */
    public function create(string $email, string $name, string $password, Role $role, User $userAuthorized): User
    {
        return $this->commandBus->dispatch(
            new RegisterNewUserCommand(
                $email,
                $name,
                $password,
                $role
            ),
            $userAuthorized
        );
    }

    /**
     * @param User $user
     * @param User $userAuthorized
     * @return User
     * @throws \Throwable
     */
    public function update(User $user, User $userAuthorized): User
    {
        return $this->commandBus->dispatch(
            new UpdateUserCommand(
                $user->id,
                $user->name,
                $user->email,
                $user->password,
                $user->role,
                $user->permissions,
                $user->twoFactorSecret,
                $user->twoFactorEnabled,
                $user->emailConfirmAt,
            ),
            $userAuthorized
        );
    }

    /**
     * @param string $id
     * @param User $userAuthorized
     * @return User|null
     * @throws \Throwable
     */
    public function findById(string $id, User $userAuthorized): ?User
    {
        return $this->commandBus->dispatch(new FindByIdCommand($id), $userAuthorized);
    }

    /**
     * @param string $email
     * @param User $userAuthorized
     * @return User|null
     * @throws \Throwable
     */
    public function findByEmail(string $email, User $userAuthorized): ?User
    {
        return $this->commandBus->dispatch(
            new FindByEmailCommand($email),
            $userAuthorized
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @param User $userAuthorized
     * @return User|null
     * @throws \Throwable
     */
    public function findByEmailAndPassword(string $email, string $password, User $userAuthorized): ?User
    {
        return $this->commandBus->dispatch(
            new FindByEmailAndPasswordCommand($email, $password),
            $userAuthorized
        );
    }

    /**
     * @param string $id
     * @param User $userAuthorized
     * @return bool
     * @throws \Throwable
     */
    public function delete(string $id, User $userAuthorized): bool
    {
        return $this->commandBus->dispatch(new DeleteUserCommand($id), $userAuthorized);
    }
}
