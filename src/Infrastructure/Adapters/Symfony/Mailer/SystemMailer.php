<?php

namespace MusicStore\Infrastructure\Adapters\Symfony\Mailer;

use MusicStore\Application\Notification\MailerInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\Email;

class SystemMailer implements MailerInterface
{
    private SymfonyMailerInterface $mailer;
    private string $connectionString;
    private string $defaultEmailUser;

    public function __construct(
        SymfonyMailerInterface $mailer,
        string $connectionString,
        string $defaultEmailUser = 'admin'
    ) {
        $this->mailer = $mailer;
        $this->connectionString = $connectionString;
        $this->defaultEmailUser = $defaultEmailUser;
    }

    public function send(string $message, array $recipients, bool $asHtml = true)
    {
        $parsedConnStr = parse_url($this->connectionString);

        $email =  (new Email())
            ->from(($parsedConnStr['user'] ?? $this->defaultEmailUser).'@'.$parsedConnStr['host'] )
            ->subject('Newly promoted album. Check it out!');

        if($asHtml) {
            $email->html($message);
        } else {
            $email->text($message);
        }

        foreach ($recipients as $recipient) {
            $email->addBcc($recipient);
        }

        $this->mailer->send($email);
    }
}