<?php declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

use Psr\Http\Message\ServerRequestInterface;
//use Slim\Factory\AppFactory;
use Slim\Psr7\Response;

require __DIR__ . '/../../vendor/autoload.php';
$baseDir = __DIR__ . '/../../';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}
//$settings = require __DIR__ . '/Settings.php';
//$app = new \Slim\App($settings);

// Read settings and create Pimple container
//$settings = require __DIR__ . '/../src/settings.php';
$settings = require __DIR__ . '/Settings.php';
$container = new Container($settings);
//$container = new Container(['settings' => ['default_name' => 'World']]);

// Create App
$app = AppFactory::create(null, new Psr11Container($container));
//$app = AppFactory::create(null, new Psr11Container(new Container()));

//$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
//$app->addErrorMiddleware(true, true, true);

// Define Custom Error Handler
$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {

    $statusCode = is_int($exception->getCode()) ? $exception->getCode() : 500;
    $className = new \ReflectionClass(get_class($exception));
    $data = [
        'message' => $exception->getMessage(),
        'class' => $className->getShortName(),
        'status' => 'error',
        'code' => $statusCode,
    ];

//    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    );

//    return $response;
    
    return $response->withStatus($statusCode)->withHeader("Content-type", "application/json");
//    $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

//    return $response->withStatus($statusCode)->withHeader("Content-type", "application/json")->write($body);
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Services.php';
require __DIR__ . '/Repositories.php';
require __DIR__ . '/Routes.php';

$app->run();
