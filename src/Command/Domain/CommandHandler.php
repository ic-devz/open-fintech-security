<?php

declare(strict_types=1);

namespace Security\Command\Domain;

interface CommandHandler
{
    public function listenTo(): string;
    public function handle(Command $command): mixed;
}
