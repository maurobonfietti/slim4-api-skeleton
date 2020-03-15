<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

class App
{
    public function getAppInstance()
    {
        require __DIR__ . '/../../vendor/autoload.php';

        $baseDir = __DIR__ . '/../../';
        $dotenv = new Dotenv\Dotenv($baseDir);
        if (file_exists($baseDir . '.env')) {
            $dotenv->load();
        }
        $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

        $settings = require __DIR__ . '/Settings.php';
        $container = new Container($settings);

        $app = AppFactory::create(null, new Psr11Container($container));
        $path = getenv('SLIM_BASE_PATH') ?: '';
        $app->setBasePath($path);
        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();

        $customErrorHandler = function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {
            $statusCode = 500;
            if (is_int($exception->getCode()) && $exception->getCode() >= 400 && $exception->getCode() <= 599) {
                $statusCode = $exception->getCode();
            }
            $className = new \ReflectionClass(get_class($exception));
            $data = [
                'message' => $exception->getMessage(),
                'class' => $className->getShortName(),
                'status' => 'error',
                'code' => $statusCode,
            ];
            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

            return $response->withStatus($statusCode)->withHeader("Content-type", "application/json");
        };

        $displayError = filter_var(getenv('DISPLAY_ERROR_DETAILS'), FILTER_VALIDATE_BOOLEAN);
        $errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);

        $app->options('/{routes:.+}', function ($request, $response, $args) {
            return $response;
        });
        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            return $response
                    ->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });

        require __DIR__ . '/Dependencies.php';
        require __DIR__ . '/Services.php';
        require __DIR__ . '/Repositories.php';
        require __DIR__ . '/Routes.php';

        $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
            throw new Slim\Exception\HttpNotFoundException($request);
        });

        return $app;
    }
}

//require __DIR__ . '/../../vendor/autoload.php';
//
//$baseDir = __DIR__ . '/../../';
//$dotenv = new Dotenv\Dotenv($baseDir);
//if (file_exists($baseDir . '.env')) {
//    $dotenv->load();
//}
//$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
//
//$settings = require __DIR__ . '/Settings.php';
//$container = new Container($settings);
//
//$app = AppFactory::create(null, new Psr11Container($container));
//$path = getenv('SLIM_BASE_PATH') ?: '';
//$app->setBasePath($path);
//$app->addRoutingMiddleware();
//$app->addBodyParsingMiddleware();
//
//$customErrorHandler = function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {
//    $statusCode = 500;
//    if (is_int($exception->getCode()) && $exception->getCode() >= 400 && $exception->getCode() <= 599) {
//        $statusCode = $exception->getCode();
//    }
//    $className = new \ReflectionClass(get_class($exception));
//    $data = [
//        'message' => $exception->getMessage(),
//        'class' => $className->getShortName(),
//        'status' => 'error',
//        'code' => $statusCode,
//    ];
//    $response = $app->getResponseFactory()->createResponse();
//    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
//
//    return $response->withStatus($statusCode)->withHeader("Content-type", "application/json");
//};
//
//$displayError = filter_var(getenv('DISPLAY_ERROR_DETAILS'), FILTER_VALIDATE_BOOLEAN);
//$errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
//$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
//
//$app->options('/{routes:.+}', function ($request, $response, $args) {
//    return $response;
//});
//$app->add(function ($request, $handler) {
//    $response = $handler->handle($request);
//    return $response
//            ->withHeader('Access-Control-Allow-Origin', '*')
//            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
//});
//
//require __DIR__ . '/Dependencies.php';
//require __DIR__ . '/Services.php';
//require __DIR__ . '/Repositories.php';
//require __DIR__ . '/Routes.php';
//
//$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
//    throw new Slim\Exception\HttpNotFoundException($request);
//});
