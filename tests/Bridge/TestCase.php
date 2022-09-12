<?php

namespace VladDnepr\GraphQLTest\Tests\Bridge;

use VladDnepr\GraphQLTest\Bridge\TestCaseTrait;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use TestCaseTrait;

    protected static string $expectedOperation = 'query';
    protected static string $expectedOperationName = '';
    protected static array $expectedHeaders = [];

    private function call(
        string $method,
        string $uri,
        array $parameters = [],
        array $cookies = [],
        array $files = [],
        array $headers = []
    ) {
        $this->assertSame('POST', $method);
        $this->assertSame(static::$endpoint, $uri);
        $this->assertArrayHasKey('query', $parameters);
        $this->assertStringContainsString(static::$expectedOperation, $parameters['query']);
        $this->assertStringContainsString(static::$expectedOperationName, $parameters['query']);
        $this->assertEmpty($files);
        $this->assertEquals(static::$expectedHeaders, $headers);
    }
}
