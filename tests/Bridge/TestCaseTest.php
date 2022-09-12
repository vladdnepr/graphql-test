<?php

namespace VladDnepr\GraphQLTest\Tests\Bridge;

use VladDnepr\GraphQLTest\Operation\Mutation;
use VladDnepr\GraphQLTest\Operation\Query;

class TestCaseTest extends TestCase
{
    public function setUp(): void
    {
        self::$expectedHeaders = ['Content-Type' => 'application/json'];
    }

    public function testQuery()
    {
        self::$expectedOperationName = 'someFakeQuery';

        $this->setDefaultHeaders(['Content-Type' => 'application/json']);

        $this->query(new Query('someFakeQuery'));
    }

    public function testMutation()
    {
        self::$expectedOperation = 'mutation';
        self::$expectedOperationName = 'someFakeMutation';

        $this->mutation(new Mutation('someFakeMutation'), [], ['Content-Type' => 'application/json']);
    }

    public function testAddHeader()
    {
        self::$expectedOperation = 'mutation';
        self::$expectedOperationName = 'someFakeMutation';

        $this->addDefaultHeader('Content-Type', 'application/json');

        $this->mutation(new Mutation('someFakeMutation'));
    }
}
