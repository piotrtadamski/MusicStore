<?php

namespace MusicStore\Application\Command\Album;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Application\Notification\MailerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;

class PromoteAlbumHandler implements CommandHandlerInterface
{
    /** @var string[] */
    private array $recipients = [];
    private AlbumRepositoryInterface $albumRepository;
    private MailerInterface $mailer;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        MailerInterface          $mailer,
        array                    $recipients = []
    )
    {
        $this->albumRepository = $albumRepository;
        $this->mailer = $mailer;
        $this->recipients = $recipients;
    }

    public function __invoke(PromoteAlbum $command)
    {
        $album = $this->albumRepository->get($command->getAlbumId());
        $album->setIsPromoted(true);
    }
}