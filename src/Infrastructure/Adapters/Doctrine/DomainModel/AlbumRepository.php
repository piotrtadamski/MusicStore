<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DomainModel;

use Doctrine\ORM\EntityManagerInterface;
use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Album\AlbumNotFoundException;
use MusicStore\Domain\Album\AlbumRepositoryInterface;

class AlbumRepository implements AlbumRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Album::class)->findAll();
    }

    public function get(int $id): Album
    {
        if( null !== ($album = $this->entityManager->getRepository(Album::class)->find($id))) {
            return $album;
        }

        throw new AlbumNotFoundException();
    }

    public function save(Album $album)
    {
        $this->entityManager->persist($album);
        return $album;
    }
}