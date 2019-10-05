<?php declare(strict_types=1);

namespace Tests\integration;

class TeamTest extends TestCase
{
    private static $id;

    public function testCreateTeam()
    {
//        $response = $this->runApp(
//            'POST',
//            '/team',
//            [
//                '' => '',
//                'name' => 'aaa',
//            ]
//        );
            
        $params = [
            'name' => 'abc',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/team');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeams()
    {
//        $response = $this->runApp('GET', '/team');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/team');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTeam()
    {
//        $response = $this->runApp('GET', '/team/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/team/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

//    public function testGetTeamNotFound()
//    {
////        $response = $this->runApp('GET', '/team/123456789');
//        $app = $this->getAppInstance();
//        $request = $this->createRequest('GET', '/team/123456789');
//        $response = $app->handle($request);
//
//        $result = (string) $response->getBody();
//
//        $this->assertEquals(404, $response->getStatusCode());
//        $this->assertStringContainsString('error', $result);
//    }

//    public function testUpdateTeam()
//    {
////        $response = $this->runApp('PUT', '/team/' . self::$id, ['' => '']);
//        $app = $this->getAppInstance();
//        $request = $this->createRequest('PUT', '/team/' . self::$id);
//        $request = $request->withParsedBody([]);
//        $response = $app->handle($request);
//
//        $result = (string) $response->getBody();
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertStringContainsString('id', $result);
//        $this->assertStringNotContainsString('error', $result);
//    }

    public function testDeleteTeam()
    {
//        $response = $this->runApp('DELETE', '/team/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/team/' . self::$id);
//        $request = $request->withParsedBody([]);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
