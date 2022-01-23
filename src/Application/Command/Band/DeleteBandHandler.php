<?php

namespace MusicStore\Application\Command\Band;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use MusicStore\Domain\Band\BandRepositoryInterface;
use MusicStore\Domain\Track\TrackRepositoryInterface;

class DeleteBandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository
    )
    {
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(DeleteBand $command)
    {
        $band = $this->bandRepository->get($command->getBandId());
        $this->bandRepository->remove($band);
    }
}