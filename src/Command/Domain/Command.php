<?php

namespace OpenFintech\Security\Command\Domain;

interface Command
{
    public function getName(): string;
    public function getContext(): array;
}
