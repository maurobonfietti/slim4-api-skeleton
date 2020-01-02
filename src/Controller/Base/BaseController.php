<?php declare(strict_types=1);

namespace App\Controller\Base;

class BaseController
{
    const API_NAME = 'slim4-api-skeleton';

    const API_VERSION = '0.0.3';

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getHelp($request, $response)
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        $payload = json_encode($message);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getStatus($request, $response)
    {
        $this->container->get('db');
        $status = [
            'status' => [
                'database' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        $payload = json_encode($status);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
