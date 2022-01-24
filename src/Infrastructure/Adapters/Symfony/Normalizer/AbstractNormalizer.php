<?php

namespace MusicStore\Infrastructure\Adapters\Symfony\Normalizer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

abstract class AbstractNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public const COMPONED_LEVEL = 'componed_level';

    public function normalize($object, $format = null, array $context = [])
    {
        $context[self::COMPONED_LEVEL] = $context[self::COMPONED_LEVEL] ?? 0;
        $isRoot = $context[self::COMPONED_LEVEL] === 0;
        $context[self::COMPONED_LEVEL]++;

        if ($isRoot) {
            return $this->normalizeFromRoot($object, $format, $context);
        }

        return $object->jsonSerialize();
    }

    abstract protected function normalizeFromRoot($object, $format, array $context);

    abstract protected function isSupported($data, $format, array $context): bool;

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof \JsonSerializable
            && $this->isSupported($data, $format, $context);
    }
}