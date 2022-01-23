<?php

namespace MusicStore\Application\Command\Album;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use MusicStore\Domain\Band\BandRepositoryInterface;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Year;

class EditAlbumHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;
    private AlbumRepositoryInterface $albumRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository,
        AlbumRepositoryInterface $albumRepository
    ) {
        $this->bandRepository = $bandRepository;
        $this->albumRepository = $albumRepository;
    }

    public function __invoke(EditAlbum $command)
    {
        $album = $this->albumRepository->get($command->getAlbumId());
        $band = $this->bandRepository->get($command->getBandId());

        $album->setTitle(Title::fromString($command->getTitle()));
        $album->setYear(Year::fromString($command->getYear()));
        $album->setBand($band);

        $this->albumRepository->save($album);
    }
}