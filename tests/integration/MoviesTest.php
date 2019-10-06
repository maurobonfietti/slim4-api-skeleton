<?php declare(strict_types=1);

namespace Tests\integration;

class MoviesTest extends TestCase
{
    private static $id;

    public function testCreateMovies()
    {
        $params = [
                '' => '',
                'title' => 'aaa',
		'imdb' => 'aaa',
		'language' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/movies');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMoviess()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/movies');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMovies()
    {
//        $response = $this->runApp('GET', '/movies/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/movies/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetMoviesNotFound()
    {
//        $response = $this->runApp('GET', '/movies/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/movies/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateMovies()
    {
//        $response = $this->runApp('PUT', '/movies/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/movies/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteMovies()
    {
//        $response = $this->runApp('DELETE', '/movies/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/movies/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
