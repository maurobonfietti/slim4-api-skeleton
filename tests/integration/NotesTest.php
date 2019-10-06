<?php declare(strict_types=1);

namespace Tests\integration;

class NotesTest extends TestCase
{
    private static $id;

    public function testCreateNotes()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/notes');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetNotess()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/notes');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetNotes()
    {
//        $response = $this->runApp('GET', '/notes/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/notes/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetNotesNotFound()
    {
//        $response = $this->runApp('GET', '/notes/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/notes/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateNotes()
    {
//        $response = $this->runApp('PUT', '/notes/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/notes/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteNotes()
    {
//        $response = $this->runApp('DELETE', '/notes/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/notes/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
