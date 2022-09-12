<?php

namespace VladDnepr\GraphQLTest\Tests\Formatter;

use VladDnepr\GraphQLTest\Formatter\ParametersFormatter;
use VladDnepr\GraphQLTest\Type\BooleanType;
use VladDnepr\GraphQLTest\Type\EnumType;
use PHPUnit\Framework\TestCase;

class ParametersFormatterTest extends TestCase
{
    /**
     * @dataProvider invokeData
     */
    public function testInvoke(string $expected, array $items)
    {
        $this->assertSame($expected, (new ParametersFormatter())($items));
    }

    public function invokeData(): array
    {
        return [
            [
                <<<GQL
(id: 1,test: "test") 
GQL
                , ['id' => 1, 'test' => 'test'],
            ],
            [
                <<<GQL
(id: 5,fake: {fake: false},test: Fake) 
GQL
                , [
                'id' => 5,
                'fake' => ['fake' => new BooleanType(false)],
                'test' => new EnumType('Fake')
                ],
            ],
        ];
    }
}
