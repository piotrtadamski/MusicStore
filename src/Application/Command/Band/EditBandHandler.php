<?php

namespace MusicStore\Application\Command\Band;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Band\BandName;
use MusicStore\Domain\Band\BandRepositoryInterface;

class EditBandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository
    )
    {
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(EditBand $command)
    {
        $band = $this->bandRepository->get($command->getBandId());
        $band->setBandName(
            BandName::fromString($command->getBandName())
        );
        $this->bandRepository->save($band);
    }
}