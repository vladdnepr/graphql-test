<?php

namespace VladDnepr\GraphQLTest\Tests\Operation;

use VladDnepr\GraphQLTest\Operation\MutationInterface;
use VladDnepr\GraphQLTest\Operation\QueryInterface;
use VladDnepr\GraphQLTest\Type\BooleanType;
use VladDnepr\GraphQLTest\Type\EnumType;
use PHPUnit\Framework\TestCase;

abstract class Operation extends TestCase
{
    /**
     * @var MutationInterface|QueryInterface $operation
     * @dataProvider invokeData
     */
    public function testInvoke(string $rawQuery, $operation)
    {
        $this->assertSame($rawQuery, $operation());
    }

    public function invokeData(): array
    {
        return [
            [
                <<<GQL
{$this->getOperationName()} {
  testing {
id
}
}
GQL
                , $this->getClass('testing', [], ['id'])
            ],
            [
                <<<GQL
{$this->getOperationName()} {
  testing (id: 1) {
id
name
}
}
GQL
                , $this->getClass('testing', ['id' => 1], ['id', 'name'])
            ],
            [
                <<<GQL
{$this->getOperationName()} {
  testing {
id
roles {
name
test {
one
}
}
field
}
}
GQL
                , $this->getClass('testing', [], ['id', 'roles' => ['name', 'test' => ['one']], 'field'])
            ],
            [
                <<<GQL
{$this->getOperationName()} {
  testing (id: 5,fake: {fake: false},test: Fake) {
id
}
}
GQL
                , $this->getClass(
                    'testing',
                    [
                        'id' => 5,
                        'fake' => ['fake' => new BooleanType(false)],
                        'test' => new EnumType('Fake')
                    ],
                    ['id']
                )
            ],
        ];
    }

    abstract protected function getOperationName(): string;
    abstract protected function getClass();
}
