<?php

namespace VladDnepr\GraphQLTest\Tests\Operation;

use VladDnepr\GraphQLTest\Operation\Mutation;

class MutationTest extends Operation
{
    protected function getOperationName(): string
    {
        return 'mutation';
    }

    protected function getClass()
    {
        return new Mutation(...func_get_args());
    }
}
