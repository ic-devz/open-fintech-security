<?php

declare(strict_types=1);

use Security\Command\Domain\CommandBus;
use Security\User\Application\Commands\FindByEmail\FindByEmailHandler;
use Security\User\Application\UserService;
use Security\User\Domain\User;
use Security\User\Infrastructure\Persistence\FakeLogger;
use Security\User\Infrastructure\Persistence\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class RegisterNewUserTest extends TestCase
{
    public function testRegisterNewUser()
    {
        $commandBus = new CommandBus(new FakeLogger());
        $commandBus->subscribe(
            new FindByEmailHandler(
                new InMemoryUserRepository()
            )
        );

        $userService = new UserService($commandBus);
        // buscar por email fake
        $user = $userService->findByEmail('jonhdue@example.io', User::fake());

        $this->assertInstanceOf(User::class, $user);
    }
}
