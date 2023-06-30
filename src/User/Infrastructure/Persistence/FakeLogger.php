<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Infrastructure\Persistence;

use OpenFintech\Security\Logger\Domain\LoggerProvider;

class FakeLogger implements LoggerProvider
{

    public function info(string $message, array $context = []): void
    {
        echo "info: $message\n" . json_encode($context) . "\n";
    }

    public function error(string $message, array $context = []): void
    {
        echo "error: $message\n" . json_encode($context) . "\n";
    }
}
