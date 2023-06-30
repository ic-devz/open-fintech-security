<?php

declare(strict_types=1);

namespace Security\Command\Domain;

use Security\Logger\Domain\LoggerProvider;
use Security\User\Domain\User;

class CommandBus
{
    /**
     * @var CommandHandler[]
     */
    private array $handlers = [];

    public function __construct(
        private readonly LoggerProvider $logger,
    ) {
    }


    public function subscribe(CommandHandler ...$handlers): void
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    /**
     * @param Command $command
     * @param User|null $user
     * @return mixed
     * @throws \Throwable
     */
    public function dispatch(Command $command, ?User $user): mixed
    {
        try {
            if ($user?->hasPermission($command->getName()) === false) {
                throw new AuthorizationException('User has no permission');
            }

            $response = $this->handlers[$command::class]->handle($command);

            $this->logger->info(
                $command->getName(),
                array_merge($command->getContext(), ["userId" => $user?->id])
            );

            return $response;
        } catch (\Throwable $exception) {
            $this->logger->error(
                $command->getName(),
                array_merge($command->getContext(), ["userId" => $user?->id])
            );

            throw $exception;
        }
    }
}
