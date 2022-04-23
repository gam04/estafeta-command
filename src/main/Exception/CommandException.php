<?php

namespace Gam\Estafeta\Command\Exception;

use Throwable;

class CommandException extends \Exception
{
    /**
     * @var array<string, mixed>
     */
    private array $errorData;

    public function __construct(string $message = '', string $jsonError = '{}', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        try {
            $this->errorData = json_decode($jsonError, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->errorData = [];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getErrorData(): array
    {
        return $this->errorData;
    }
}
