<?php declare(strict_types=1);

namespace Tests\integration;

class TasksTest extends TestCase
{
    private static $id;

    public function testCreateTasks()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
		'status' => 1,
		'userId' => 1,
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/tasks');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTaskss()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/tasks');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTasks()
    {
//        $response = $this->runApp('GET', '/tasks/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/tasks/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetTasksNotFound()
    {
//        $response = $this->runApp('GET', '/tasks/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/tasks/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateTasks()
    {
//        $response = $this->runApp('PUT', '/tasks/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/tasks/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteTasks()
    {
//        $response = $this->runApp('DELETE', '/tasks/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/tasks/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
