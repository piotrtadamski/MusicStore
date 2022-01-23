<?php

namespace MusicStore\Application\Command\Album;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;

class PromoteAlbumHandler implements CommandHandlerInterface
{
    private AlbumRepositoryInterface $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function __invoke(PromoteAlbum $command)
    {
        $album = $this->albumRepository->get($command->getAlbumId());
        $album->setIsPromoted(true);
    }
}