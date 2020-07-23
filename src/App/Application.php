<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

$container = new Container();
$app = AppFactory::create(null, new Psr11Container($container));
$path = getenv('SLIM_BASE_PATH') ?: '';
$app->setBasePath($path);
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
