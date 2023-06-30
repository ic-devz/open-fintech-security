<?php

declare(strict_types=1);

namespace Security\User\Domain;

interface Id
{
    public static function generate(): static;
}
