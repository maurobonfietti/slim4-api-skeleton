<?php declare(strict_types=1);

namespace Tests\integration;

class TeamsTest extends TestCase
{
    private static $id;

    public function testCreateTeams()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/teams');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeamss()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/teams');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeams()
    {
//        $response = $this->runApp('GET', '/teams/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/teams/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeamsNotFound()
    {
//        $response = $this->runApp('GET', '/teams/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/teams/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateTeams()
    {
//        $response = $this->runApp('PUT', '/teams/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/teams/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteTeams()
    {
//        $response = $this->runApp('DELETE', '/teams/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/teams/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
