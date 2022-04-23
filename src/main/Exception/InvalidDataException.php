<?php

namespace Gam\Estafeta\Command\Exception;

use Throwable;

class InvalidDataException extends \RuntimeException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
