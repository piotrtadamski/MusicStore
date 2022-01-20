<?php

namespace MusicStore\Domain\Common\Types;

use LogicException;
use Throwable;

class EntityNotFoundException extends LogicException
{
    public function __construct(
        string $entityName,
        array $params,
        $code = 0,
        Throwable $previous = null
    ) {
        $message = 'Item of type \'%s\' was not found. It was searched using given parameters:';
        foreach ($params as $field => $value) {
            $message .= sprintf(' [%s=\'%s\']', $field, $value);
        }

        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}