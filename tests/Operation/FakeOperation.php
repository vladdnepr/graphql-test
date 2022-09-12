<?php

namespace VladDnepr\GraphQLTest\Tests\Operation;

use VladDnepr\GraphQLTest\Operation\Operation as RealOperation;

class FakeOperation extends RealOperation
{
    public function getOperationName(): string
    {
        return 'fake?';
    }

    protected function initializeFormatters(): void
    {
    }
}
