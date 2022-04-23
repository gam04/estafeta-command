<?php

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Helpers\Arrays;

class Frecuency
{
    private const TRUE = 'Y';

    private const FALSE = 'N';

    private const ON = '1';

    private const OFF = '0';

    private bool $ocurs;

    private bool $warranty;

    private string $reexp;

    /**
     * @var string[]
     */
    private array $matrix;

    public static function default(): self
    {
        $frecuency = [
            'ocurre' => self::OFF,
            'garantia' => self::TRUE,
            'reexp' => '',
            [
                'lu' => self::TRUE,
                'ma' => self::TRUE,
                'mi' => self::TRUE,
                'ju' => self::TRUE,
                'vi' => self::TRUE,
                'sa' => self::FALSE,
                'dom' => self::FALSE,
            ],
        ];
        return self::fromJsonResponse($frecuency);
    }

    /**
     * @param array<string|int, mixed> $data
     * @return self
     */
    public static function fromJsonResponse(array $data): self
    {
        $matrix = Arrays::only($data, ['lu', 'ma', 'mi', 'ju', 'vi', 'sa', 'dom']);
        return new self(
            self::ON === $data['ocurre'],
            ($data['garantia'] ?? '') === self::TRUE,
            $data['reexp'] ?? '',
            $matrix
        );
    }

    /**
     * @param bool $ocurs
     * @param bool $warranty
     * @param string $reexp
     * @param string[] $matrix
     */
    public function __construct(
        bool $ocurs,
        bool $warranty,
        string $reexp,
        array $matrix
    ) {
        $this->ocurs = $ocurs;
        $this->warranty = $warranty;
        $this->reexp = $reexp;
        $this->matrix = $matrix;
    }

    /**
     * @return bool
     */
    public function ocurs(): bool
    {
        return $this->ocurs;
    }

    public function ocursValue(): string
    {
        return $this->ocurs
            ? self::TRUE
            : self::FALSE;
    }

    /**
     * @return bool
     */
    public function hasWarranty(): bool
    {
        return $this->warranty;
    }

    public function warrantyValue(): string
    {
        return $this->warranty
            ? self::TRUE
            : self::FALSE;
    }

    /**
     * @return string
     */
    public function getReexp(): string
    {
        return $this->reexp;
    }

    public function onMonday(): bool
    {
        return self::TRUE === $this->matrix['lu'];
    }

    public function onTuesday(): bool
    {
        return self::TRUE === $this->matrix['ma'];
    }

    public function onWednesday(): bool
    {
        return self::TRUE === $this->matrix['mi'];
    }

    public function onThursday(): bool
    {
        return self::TRUE === $this->matrix['ju'];
    }

    public function onFriday(): bool
    {
        return self::TRUE === $this->matrix['vi'];
    }

    public function onSaturday(): bool
    {
        return self::TRUE === $this->matrix['sa'];
    }

    public function onSunday(): bool
    {
        return self::TRUE === $this->matrix['dom'];
    }
}
