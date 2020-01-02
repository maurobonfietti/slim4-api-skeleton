<?php declare(strict_types=1);

namespace Tests\integration;

class BaseControllerTest extends TestCase
{
    public function testApiHelp()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/');
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringNotContainsString('error', (string) $response->getBody());
    }

    public function testStatus()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/status');
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringContainsString('database', (string) $response->getBody());
        $this->assertStringNotContainsString('error', (string) $response->getBody());
        $this->assertStringNotContainsString('failed', (string) $response->getBody());
        $this->assertStringNotContainsString('PDOException', (string) $response->getBody());
    }
}
