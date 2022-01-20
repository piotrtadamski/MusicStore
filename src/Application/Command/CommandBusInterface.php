<?php

declare(strict_types=1);

namespace MusicStore\Application\Command;

interface CommandBusInterface
{
    public function dispatch(object $command): void;
}
