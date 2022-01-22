<?php

namespace MusicStore\Application\Command\Track;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Url;
use MusicStore\Domain\Track\Track;
use MusicStore\Domain\Track\TrackRepositoryInterface;

class AddTrackHandler implements CommandHandlerInterface
{
    private AlbumRepositoryInterface $albumRepository;
    private TrackRepositoryInterface $trackRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        TrackRepositoryInterface $trackRepository
    )
    {
        $this->albumRepository = $albumRepository;
        $this->trackRepository = $trackRepository;
    }

    public function __invoke(AddTrack $command)
    {
        $album = $this->albumRepository->get($command->getAlbumId());

        $track = Track::create(
            Title::fromString($command->getTitle()),
            Url::fromString($command->getUrl()),
            $album
        );

        $this->trackRepository->save($track);
    }
}