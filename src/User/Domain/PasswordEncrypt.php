<?php

declare(strict_types=1);

namespace Security\User\Domain;

interface PasswordEncrypt
{
    public function encrypt(string $password): string;
    public function verify(string $password, string $hash): bool;
}
