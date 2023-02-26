<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

$container = new Container();

return AppFactory::create(
    new ResponseFactory(),
    new Psr11Container($container)
);
