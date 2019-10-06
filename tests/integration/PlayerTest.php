<?php declare(strict_types=1);

namespace Tests\integration;

class PlayerTest extends TestCase
{
    private static $id;

    public function testCreatePlayer()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/player');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPlayers()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/player');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPlayer()
    {
//        $response = $this->runApp('GET', '/player/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/player/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetPlayerNotFound()
    {
//        $response = $this->runApp('GET', '/player/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/player/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdatePlayer()
    {
//        $response = $this->runApp('PUT', '/player/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/player/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeletePlayer()
    {
//        $response = $this->runApp('DELETE', '/player/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/player/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
