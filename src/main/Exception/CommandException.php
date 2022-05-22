<?php

namespace Gam\Estafeta\Command\Exception;

use Throwable;

class CommandException extends \Exception
{
    /**
     * @var array<int, mixed>
     */
    private array $errorData;

    /**
     * @param string $message
     * @param array<int, mixed> $errorData
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        array $errorData = [],
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->errorData = $errorData;
    }

    /**
     * @return array<int, mixed>
     */
    public function getErrorData(): array
    {
        return $this->errorData;
    }

    public function getFirstError(): string
    {
        return $this->errorData[0] ?? '';
    }
}
