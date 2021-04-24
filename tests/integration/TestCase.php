<?php

declare(strict_types=1);

namespace Tests\integration;

use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Slim\App;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Uri;

class TestCase extends PHPUnit_TestCase
{
    protected function getAppInstance(): App
    {
        return require __DIR__ . '/../../src/App/App.php';
    }

    protected function createRequest(
        string $method,
        string $path,
        string $query = '',
        array $headers = ['HTTP_ACCEPT' => 'application/json'],
        array $cookies = [],
        array $serverParams = []
    ): SlimRequest {
        $uri = new Uri('', '', 80, $path, $query);
        $handle = fopen('php://temp', 'w+');
        $stream = (new StreamFactory())->createStreamFromResource($handle);

        $h = new Headers();
        foreach ($headers as $name => $value) {
            $h->addHeader($name, $value);
        }

        return new SlimRequest($method, $uri, $h, $cookies, $serverParams, $stream);
    }
}
