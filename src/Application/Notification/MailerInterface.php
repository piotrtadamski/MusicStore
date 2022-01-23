<?php

namespace MusicStore\Application\Notification;

interface MailerInterface
{
    public function send(string $message, array $recipients, bool $asHtml = true);
}