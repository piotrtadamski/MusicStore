<?php

namespace MusicStore\Application\Command\Album;

use MusicStore\Application\Command\CommandHandlerInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;

class DeleteAlbumHandler implements CommandHandlerInterface
{
    private AlbumRepositoryInterface $albumRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository
    )
    {
        $this->albumRepository = $albumRepository;
    }

    public function __invoke(DeleteAlbum $command)
    {
        $album = $this->albumRepository->get($command->getAlbumId());
        $this->albumRepository->remove($album);
    }
}