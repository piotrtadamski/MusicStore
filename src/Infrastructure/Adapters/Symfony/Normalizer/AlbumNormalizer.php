<?php

namespace MusicStore\Infrastructure\Adapters\Symfony\Normalizer;

use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Track\Track;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class AlbumNormalizer extends AbstractNormalizer
{
    /**
     * @param Album $object
     * @param string|null $format
     * @param array $context
     * @return array
     * @throws ExceptionInterface
     */
    protected function normalizeFromRoot($object, $format, array $context)
    {
        return array_merge($object->jsonSerialize(), [
            'band' => $this->normalize($object->getBand(), $format, $context),
            'tracks' => array_map(function (Track $track) use ($format, $context) {
                return $this->normalize($track, $format, $context);
            }, $object->getTracks()->toArray())
        ]);
    }

    protected function isSupported($data, $format, array $context): bool
    {
        return $data instanceof Album;
    }
}