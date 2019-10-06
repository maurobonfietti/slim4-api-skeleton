<?php declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';
$baseDir = __DIR__ . '/../../';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}
$settings = require __DIR__ . '/Settings.php';
$container = new Container($settings);

$app = AppFactory::create(null, new Psr11Container($container));

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$customErrorHandler = function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {
    $statusCode = is_int($exception->getCode()) ? $exception->getCode() : 500;
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

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Services.php';
require __DIR__ . '/Repositories.php';
require __DIR__ . '/Routes.php';
