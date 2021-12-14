<?php

namespace Tests\integration;

require_once __DIR__.'/../../src/App/CustomResponse.php';
require_once __DIR__.'/../../src/App/ResponseFactory.php';

use App\CustomResponse as Response;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

class CustomResponseTest extends TestCase
{
    public function testWithJson()
    {
        $app = AppFactory::create(new \ResponseFactory());
        $data = ['foo' => 'bar1&bar2'];

        $app->get('/path', function (Request $request, Response $response) use ($data): Response {
            return $response->withJson($data, 201);
        });

        $request = $this->createRequest('GET', '/path');
        $response = $app->handle($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/json;charset=utf-8', $response->getHeaderLine('Content-Type'));

        $body = $response->getBody();
        $body->rewind();
        $dataJson = $body->getContents();

        $this->assertEquals('{"foo":"bar1&bar2"}', $dataJson);
        $this->assertEquals($data['foo'], json_decode($dataJson, true)['foo']);
    }

    public function testWithJsonEncodingOption()
    {
        $app = AppFactory::create(new \ResponseFactory());
        $data = ['foo' => 'bar1&bar2'];

        $app->get('/path', function (Request $request, Response $response) use ($data): Response {
            return $response->withJson($data, 200, JSON_HEX_AMP);
        });

        $request = $this->createRequest('GET', '/path');
        $response = $app->handle($request);

        $body = $response->getBody();
        $body->rewind();
        $dataJson = $body->getContents();

        $this->assertEquals('{"foo":"bar1\u0026bar2"}', $dataJson);
        $this->assertEquals($data['foo'], json_decode($dataJson, true)['foo']);
    }

    public function testWithJsonThrowsException()
    {
        $app = AppFactory::create(new  \ResponseFactory());
        $data = ["text" => "\xB1\x31"];
        $app->get('/path', function (Request $request, Response $response) use ($data): Response {
            return $response->withJson($data, 200);
        });

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Malformed UTF-8 characters, possibly incorrectly encoded');

        $request = $this->createRequest('GET', '/path');
        $app->handle($request);
    }
}
