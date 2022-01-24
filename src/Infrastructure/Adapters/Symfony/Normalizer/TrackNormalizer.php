<?php

namespace MusicStore\Infrastructure\Adapters\Symfony\Normalizer;

use MusicStore\Domain\Track\Track;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class TrackNormalizer extends AbstractNormalizer
{
    /**
     * @param Track $object
     * @param string|null $format
     * @param array $context
     * @return array
     * @throws ExceptionInterface
     */
    protected function normalizeFromRoot($object, $format, array $context)
    {
        return array_merge($object->jsonSerialize(), [
            'album' => $this->normalize($object->getAlbum(), $format, $context)
        ]);
    }

    protected function isSupported($data, $format, array $context): bool
    {
        return $data instanceof Track;
    }

}