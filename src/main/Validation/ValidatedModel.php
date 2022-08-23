<?php

namespace Gam\Estafeta\Command\Validation;

abstract class ValidatedModel
{
    use ValidatesData, HasNotQuotes;

    private static bool $prepareData = true;

    /**
     * @var array<string, callable[]|callable>
     */
    private static array $prepareCallbacks = [];

    public static function disablePrepareData(): void
    {
        self::$prepareData = false;
    }

    public static function enablePrepareData(): void
    {
        self::$prepareData = true;
    }

    /**
     * @param callable[]|callable[][] $callbacks
     */
    public static function registerPrepareCallbacks(array $callbacks): void
    {
        self::$prepareCallbacks = $callbacks;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->_prepareDataBefore = self::$prepareData;
        $this->validate($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    protected function beforeValidation(array $data = null): array
    {
        $_data = $this->removeQuotes($data);
        return \Gam\Estafeta\Command\Validation\Cleaner::arrayCallback(
            array_merge($this->prepareData(), self::$prepareCallbacks),
            $_data
        );
    }

    /**
     * @return callable[]
     */
    protected function prepareData(): array
    {
        return [];
    }
}
