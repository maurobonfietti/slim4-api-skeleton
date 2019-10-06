<?php declare(strict_types=1);

namespace Tests\integration;

class UsersTest extends TestCase
{
    private static $id;

    public function testCreateUsers()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
		'email' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/users');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUserss()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/users');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUsers()
    {
//        $response = $this->runApp('GET', '/users/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/users/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUsersNotFound()
    {
//        $response = $this->runApp('GET', '/users/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/users/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateUsers()
    {
//        $response = $this->runApp('PUT', '/users/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/users/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteUsers()
    {
//        $response = $this->runApp('DELETE', '/users/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/users/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
