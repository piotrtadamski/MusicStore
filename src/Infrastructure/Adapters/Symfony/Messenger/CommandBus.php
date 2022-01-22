<?php

use Symfony\Component\Messenger\MessageBusInterface;
use MusicStore\Application\Command\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatch(object $command): void
    {
        $this->messageBus->dispatch($command);
    }
}