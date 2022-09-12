<?php

namespace VladDnepr\GraphQLTest\Tests\Type;

use VladDnepr\GraphQLTest\Type\BooleanType;
use PHPUnit\Framework\TestCase;

class BooleanTypeTest extends TestCase
{
    /**
     * @dataProvider invokeData
     */
    public function testInvoke(bool $value, string $identifier, string $expected)
    {
        $this->assertSame($expected, (new BooleanType($value))($identifier));
    }

    public function invokeData(): array
    {
        return [
            [
                true,
                'bool',
                'bool: true'
            ],
            [
                false,
                'fake',
                'fake: false'
            ],
        ];
    }
}
