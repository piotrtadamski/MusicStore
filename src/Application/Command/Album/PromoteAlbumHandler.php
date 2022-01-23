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

        if (!$album->isPromoted()) {
            $album->setIsPromoted(true);
            $this->mailer->send(
                sprintf(
                    'We set new promotion for <b> %s</b>. The album was published in %s year by %s. Click hear ( :)) ) and enjoy',
                    $album->getTitle(),
                    $album->getYear(),
                    $album->getBand()->getBandName()
                ),
                $this->recipients,
            );
            $this->albumRepository->save($album);
        }
    }
}