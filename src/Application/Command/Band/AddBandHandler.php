<?php

namespace MusicStore\Application\Command\Band;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Band\Band;
use MusicStore\Domain\Band\BandName;
use MusicStore\Domain\Band\BandRepositoryInterface;

class AddBandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository
    )
    {
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(AddBand $command)
    {
        $band = Band::create(
            BandName::fromString($command->getBandName()),
        );

        $this->bandRepository->save($band);
    }
}