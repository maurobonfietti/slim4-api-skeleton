<?php

declare(strict_types=1);

namespace App\Controller;

use Pimple\Psr11\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Home
{
    private const API_NAME = 'slim4-api-skeleton';

    private const API_VERSION = '0.6.0';

    private Container $container;

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
        $payload = json_encode($message);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function getStatus(Request $request, Response $response): Response
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

    public static function postCreateProjectCommand(): void
    {
        echo self::messagePostCreateProjectCommand(self::API_VERSION);
    }

    public static function messagePostCreateProjectCommand($version): string
    {
        return <<<EOF
   _____ _ _             _  _              
  / ____| (_)           | || |             
 | (___ | |_ _ __ ___   | || |_            
  \___ \| | | '_ ` _ \  |__   _|           
  ____) | | | | | | | |    | |             
 |_____/|_|_|_| |_| |_|    |_| _____ _____ 
  / ____| |      | |     /\   |  __ \_   _|
 | (___ | | _____| |    /  \  | |__) || |  
  \___ \| |/ / _ \ |   / /\ \ |  ___/ | |  
  ____) |   <  __/ |  / ____ \| |    _| |_ 
 |_____/|_|\_\___|_| /_/    \_\_|   |_____|

*************************************************************
Project: https://github.com/maurobonfietti/slim4-api-skeleton
Version: ${version}
*************************************************************

Successfully created project!

Get started with the following commands:

$ cd [my-api-name]
$ composer test
$ composer start

(P.S. set your MySQL connection in .env file)

Thanks for installing this project!

Now go build a cool RESTful API ;-)

EOF;
    }
}
