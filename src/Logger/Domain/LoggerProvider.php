<?php

declare(strict_types=1);

namespace OpenFintech\Security\Logger\Domain;

interface LoggerProvider
{
    public function info(string $message, array $context = []): void;
    public function error(string $message, array $context = []): void;
}
