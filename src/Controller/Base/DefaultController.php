<?php declare(strict_types=1);

namespace App\Controller\Base;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class DefaultController
{
    const API_NAME = 'skel-api-slim-php';

    const API_VERSION = '0.0.1';

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getHelp(Request $request, Response $response): Response
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($message, 200);
    }

    public function getStatus(Request $request, Response $response): Response
    {
        $status = [
            'db-stats' => [],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($status, 200);
    }
}
