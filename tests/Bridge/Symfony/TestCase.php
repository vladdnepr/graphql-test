<?php

namespace VladDnepr\GraphQLTest\Tests\Bridge\Symfony;

use VladDnepr\GraphQLTest\Bridge\Symfony\TestCase as BaseTestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\CookieJar;

abstract class TestCase extends BaseTestCase
{
    use ProphecyTrait;

    private static object $client;
    protected static object $cookieJar;

    public function setUp(): void
    {
        $client = $this->prophesize(KernelBrowser::class);
        static::$cookieJar = $this->prophesize(CookieJar::class);

        $client->getCookieJar()->willReturn(static::$cookieJar->reveal());

        $client->request(
            'POST',
            static::$endpoint,
            Argument::type('array'),
            Argument::type('array'),
            Argument::type('array')
        )->shouldBeCalledTimes(1);

        /** @var KernelBrowser $clientMock */
        $clientMock = $client->reveal();
        self::$client = $clientMock;
    }

    protected static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        return self::$client;
    }
}
