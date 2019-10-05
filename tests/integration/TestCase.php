<?php
declare(strict_types=1);

//namespace Tests;

namespace Tests\integration;

//use DI\ContainerBuilder;
use Exception;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Psr\Http\Message\ServerRequestInterface as Request;
//use Slim\App;
//use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Uri;


use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

//use Psr\Http\Message\ServerRequestInterface;
//use Slim\Factory\AppFactory;
//use Slim\Psr7\Response;


class TestCase extends PHPUnit_TestCase
{
    /**
     * @return App
     * @throws Exception
     */
    protected function getAppInstance()
    {
        

        require __DIR__ . '/../../vendor/autoload.php';
//        $baseDir = __DIR__ . '/../../';
//        $envFile = $baseDir . '.env';
//        if (file_exists($envFile)) {
//            $dotenv = new Dotenv\Dotenv($baseDir);
//            $dotenv->load();
//        }
        
        $baseDir = __DIR__ . '/../../';
        $envFile = $baseDir . '.env';
        if (file_exists($envFile)) {
            $dotenv = new \Dotenv\Dotenv($baseDir);
            $dotenv->load();
        }
        $settings = require $baseDir . 'src/App/Settings.php';
        
        //$settings = require __DIR__ . '/Settings.php';
        //$app = new \Slim\App($settings);

        // Read settings and create Pimple container
        //$settings = require __DIR__ . '/../src/settings.php';
//        $settings = require __DIR__ . '/Settings.php';
        $container = new Container($settings);
        //$container = new Container(['settings' => ['default_name' => 'World']]);

        // Create App
        $app = AppFactory::create(null, new Psr11Container($container));
        //$app = AppFactory::create(null, new Psr11Container(new Container()));

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        require $baseDir . 'src/App/Dependencies.php';
        require $baseDir . 'src/App/Services.php';
        require $baseDir . 'src/App/Repositories.php';
        require $baseDir . 'src/App/Routes.php';

        return $app;
        
        
//        // Instantiate PHP-DI ContainerBuilder
//        $containerBuilder = new ContainerBuilder();
//
//        // Container intentionally not compiled for tests.
//
//        // Set up settings
//        $settings = require __DIR__ . '/../app/settings.php';
//        $settings($containerBuilder);
//
//        // Set up dependencies
//        $dependencies = require __DIR__ . '/../app/dependencies.php';
//        $dependencies($containerBuilder);
//
//        // Set up repositories
//        $repositories = require __DIR__ . '/../app/repositories.php';
//        $repositories($containerBuilder);
//
//        // Build PHP-DI Container instance
//        $container = $containerBuilder->build();
//
//        // Instantiate the app
//        AppFactory::setContainer($container);
//        $app = AppFactory::create();
//
//        // Register middleware
//        $middleware = require __DIR__ . '/../app/middleware.php';
//        $middleware($app);
//
//        // Register routes
//        $routes = require __DIR__ . '/../app/routes.php';
//        $routes($app);
//
//        return $app;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $headers
     * @param array  $serverParams
     * @param array  $cookies
     * @return Request
     */
    protected function createRequest(
        string $method,
        string $path,
        array $headers = ['HTTP_ACCEPT' => 'application/json'],
        array $serverParams = [],
        array $cookies = []
    ) {
        $uri = new Uri('', '', 80, $path);
        $handle = fopen('php://temp', 'w+');
        $stream = (new StreamFactory())->createStreamFromResource($handle);

        $h = new Headers();
        foreach ($headers as $name => $value) {
            $h->addHeader($name, $value);
        }

        return new SlimRequest($method, $uri, $h, $serverParams, $cookies, $stream);
    }
}
