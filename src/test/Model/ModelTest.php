<?php

namespace Gam\Estafeta\Command\Test\Model;

use Gam\Estafeta\Command\Model\Model;

class ModelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function createModelFromAttributes(): void
    {
        $model = new class() extends Model {
            protected array $allowedProperties = [
                'name', 'age', 'nickname',
            ];
        };

        $user = new $model([
            'name' => 'foo',
            'age' => 99,
            'nickname' => 'bar',
        ]);
        /**
         * @phpstan-ignore-nextline
         */
        self::assertObjectHasAttribute('name', $user);
        self::assertObjectHasAttribute('age', $user);
        self::assertObjectHasAttribute('nickname', $user);
    }

    /**
     * @test
     */
    public function ignoreNotAllowedAttribute(): void
    {
        $model = new class() extends Model {
            protected array $allowedProperties = [
                'name', 'age', 'nickname',
            ];
        };

        $user = new $model([
            'name' => 'foo',
            'age' => 99,
            'nickname' => 'bar',
            'id' => '0012',
        ]);
        self::assertObjectNotHasAttribute('id', $user);
    }
}
