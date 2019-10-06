<?php declare(strict_types=1);

namespace Tests\integration;

class UserTest extends TestCase
{
    private static $id;

    public function testCreateUser()
    {
        $params = [
                '' => '',
                'email' => 'aaa',
		'email_verified' => 1,
		'deleted' => 1,
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/user');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUsers()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/user');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUser()
    {
//        $response = $this->runApp('GET', '/user/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/user/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetUserNotFound()
    {
//        $response = $this->runApp('GET', '/user/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/user/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateUser()
    {
//        $response = $this->runApp('PUT', '/user/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/user/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteUser()
    {
//        $response = $this->runApp('DELETE', '/user/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/user/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
