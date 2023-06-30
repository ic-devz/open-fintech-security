<?php

declare(strict_types=1);

namespace OpenFintech\Security\User\Domain;

interface Id
{
    public static function generate(): static;
}
