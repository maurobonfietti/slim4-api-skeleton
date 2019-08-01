<?php declare(strict_types=1);

namespace Tests\integration;

class BaseTest extends BaseTestCase
{
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringNotContainsString('error', (string) $response->getBody());
    }
}
