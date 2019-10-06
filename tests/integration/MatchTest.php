<?php declare(strict_types=1);

namespace Tests\integration;

class MatchTest extends TestCase
{
    private static $id;

    public function testCreateMatch()
    {
        $params = [
                '' => '',
                
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/match');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMatchs()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/match');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMatch()
    {
//        $response = $this->runApp('GET', '/match/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/match/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMatchNotFound()
    {
//        $response = $this->runApp('GET', '/match/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/match/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateMatch()
    {
//        $response = $this->runApp('PUT', '/match/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/match/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteMatch()
    {
//        $response = $this->runApp('DELETE', '/match/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/match/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
