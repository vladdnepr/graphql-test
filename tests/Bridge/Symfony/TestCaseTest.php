<?php

namespace VladDnepr\GraphQLTest\Tests\Bridge\Symfony;

use VladDnepr\GraphQLTest\Operation\Mutation;
use VladDnepr\GraphQLTest\Operation\Query;
use Symfony\Component\BrowserKit\Cookie;

class TestCaseTest extends TestCase
{
    public function testQuery()
    {
        $this->setDefaultHeaders(['Content-Type' => 'application/json']);

        $this->query(new Query('someFakeQuery'));
    }

    public function testMutation()
    {
        static::$cookieJar->set($cookie = new Cookie('fake', 'cookie'));

        $this->mutation(
            new Mutation('someFakeMutation'),
            [],
            ['Content-Type' => 'application/json'],
            [$cookie]
        );
    }
}
