<?php

namespace MusicStore\Application\Command\Album;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use MusicStore\Domain\Band\BandRepositoryInterface;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Year;

class AddAlbumHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;
    private AlbumRepositoryInterface $albumRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        BandRepositoryInterface $bandRepository
    )
    {
        $this->albumRepository = $albumRepository;
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(AddAlbum $command)
    {
        $band = $this->bandRepository->get($command->getBandId());

        $album = Album::create(
            Title::fromString($command->getTitle()),
            Year::fromString($command->getYear()),
            $band
        );

        $this->albumRepository->save($album);
    }
}