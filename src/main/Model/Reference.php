<?php

/** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

namespace Gam\Estafeta\Command\Model;

use Gam\Estafeta\Command\Validation\Rules;
use Gam\Estafeta\Command\Validation\ValidatedModel;
use Nette\Schema\Expect;

class Reference extends ValidatedModel
{
    private string $betweenStreet;

    private string $andStreet;

    private ?string $shed;

    private ?string $platform;

    private ?string $references;

    /**
     * @param string $betweenStreet
     * @param string $andStreet
     * @param string|null $shed
     * @param string|null $platform
     * @param string|null $references
     */
    public function __construct(
        string $betweenStreet,
        string $andStreet,
        ?string $shed = null,
        ?string $platform = null,
        ?string $references = null
    ) {
        parent::__construct(compact(['betweenStreet', 'andStreet', 'shed', 'platform', 'references']));
        $this->betweenStreet = $this->normalized->betweenStreet;
        $this->andStreet = $this->normalized->andStreet;
        $this->shed = $this->normalized->shed;
        $this->platform = $this->normalized->platform;
        $this->references = $this->normalized->references;
    }

    /**
     * @return string
     */
    public function getBetweenStreet(): string
    {
        return $this->betweenStreet;
    }

    /**
     * @return string
     */
    public function getAndStreet(): string
    {
        return $this->andStreet;
    }

    /**
     * @return string|null
     */
    public function getShed(): ?string
    {
        return $this->shed;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @return string|null
     */
    public function getReferences(): ?string
    {
        return $this->references;
    }

    protected function validationRules(): array
    {
        return [
            'betweenStreet' => Expect::string()->min(1)->max(50)
                ->assert(...Rules::alphanumeric()),
            'andStreet' => Expect::string()->min(1)->max(50)
                ->assert(...Rules::alphanumeric()),
            'shed' => Expect::string()->nullable()
                ->min(1)->max(5)
                ->assert(...Rules::alphanumeric()),
            'platform' => Expect::string()->nullable()
                ->min(1)->max(5)
                ->assert(...Rules::alphanumeric()),
            'references' => Expect::string()->nullable()
                ->min(1)->max(200)
                ->assert(...Rules::alphanumeric()),
        ];
    }

    protected function prepareData(): array
    {
        return [
            'betweenStreet' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'andStreet' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'shed' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'platform' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
            'references' => [\Gam\Estafeta\Command\Validation\Cleaner::class, 'ofAlphanumeric'],
        ];
    }
}
