<?php

namespace MusicStore\Application\Command\Track;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Url;
use MusicStore\Domain\Track\TrackRepositoryInterface;

class EditTrackHandler implements CommandHandlerInterface
{
    private AlbumRepositoryInterface $albumRepository;
    private TrackRepositoryInterface $trackRepository;

    public function __construct(
        TrackRepositoryInterface $trackRepository,
        AlbumRepositoryInterface $albumRepository
    ) {
        $this->trackRepository = $trackRepository;
        $this->albumRepository = $albumRepository;
    }

    public function __invoke(EditTrack $command)
    {
        $track = $this->trackRepository->get($command->getTrackId());
        $album = $this->albumRepository->get($command->getAlbumId());

        $track->setTitle(Title::fromString($command->getTitle()));
        $track->setUrl(Url::fromString($command->getUrl()));
        $track->setAlbum($album);

        $this->trackRepository->save($track);
    }
}