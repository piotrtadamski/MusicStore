<?php

declare(strict_types=1);

namespace MusicStore\Application\Command;

interface CommandBus
{
    public function dispatch(object $command): void;
}
