<?php

declare(strict_types=1);

namespace Tests\integration;

class HomeControllerTest extends TestCase
{
    public function testApiHelp()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testStatus()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/status');
        $response = $app->handle($request);

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
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/notfound');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
        $this->assertStringContainsString('Not found.', $result);
        $this->assertStringContainsString('HttpNotFoundException', $result);
    }

    public function testPreflightOptions()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('OPTIONS', '/status');
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
