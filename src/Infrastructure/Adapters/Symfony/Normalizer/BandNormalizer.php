<?php

namespace MusicStore\Infrastructure\Adapters\Symfony\Normalizer;

use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Band\Band;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class BandNormalizer extends AbstractNormalizer
{
    /**
     * @param Band $object
     * @param string|null $format
     * @param array $context
     * @return array
     * @throws ExceptionInterface
     */
    protected function normalizeFromRoot($object, $format, array $context)
    {
        return array_merge($object->jsonSerialize(), [
            'albums' => array_map(function (Album $album) use ($format, $context) {
                return $this->normalize($album, $format, $context);
            }, $object->getAlbums()->toArray())
        ]);
    }

    protected function isSupported($data, $format, array $context): bool
    {
        return $data instanceof Band;
    }
}