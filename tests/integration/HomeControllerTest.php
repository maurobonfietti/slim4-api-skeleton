<?php

declare(strict_types=1);

namespace Tests\integration;

class HomeControllerTest extends TestCase
{
    public function testApiHelp()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testStatus()
    {
        $request = $this->createRequest('GET', '/status');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringContainsString('database', $result);
        $this->assertStringNotContainsString('error', $result);
        $this->assertStringNotContainsString('failed', $result);
        $this->assertStringNotContainsString('PDOException', $result);
    }

    public function testNotFoundException()
    {
        $request = $this->createRequest('GET', '/notfound');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
        $this->assertStringContainsString('Not found.', $result);
        $this->assertStringContainsString('HttpNotFoundException', $result);
    }

    public function testPreflightOptions()
    {
        $request = $this->createRequest('OPTIONS', '/status');
        $response = $this->getAppInstance()->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
