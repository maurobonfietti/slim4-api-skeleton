<?php

declare(strict_types=1);

namespace Tests\integration;

use Fig\Http\Message\StatusCodeInterface;

class HomeTest extends TestCase
{
    public function testGetHelp(): void
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetStatus(): void
    {
        $request = $this->createRequest('GET', '/status');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringContainsString('database', $result);
        $this->assertStringNotContainsString('error', $result);
        $this->assertStringNotContainsString('failed', $result);
        $this->assertStringNotContainsString('PDOException', $result);
    }

    public function testPreflightOptions(): void
    {
        $request = $this->createRequest('OPTIONS', '/status');
        $response = $this->getAppInstance()->handle($request);

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }

    public function testRouteNotFoundException(): void
    {
        $request = $this->createRequest('GET', '/notfound');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_NOT_FOUND, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
        $this->assertStringContainsString('Not found.', $result);
        $this->assertStringContainsString('HttpNotFoundException', $result);
    }
}
