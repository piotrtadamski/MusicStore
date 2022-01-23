<?php

namespace MusicStore\Application\Command\Track;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Track\TrackRepositoryInterface;

class DeleteTrackHandler implements CommandHandlerInterface
{
    private TrackRepositoryInterface $trackRepository;

    public function __construct(
        TrackRepositoryInterface $trackRepository
    )
    {
        $this->trackRepository = $trackRepository;
    }

    public function __invoke(DeleteTrack $command)
    {
        $track = $this->trackRepository->get($command->getTrackId());
        $this->trackRepository->remove($track);
    }
}