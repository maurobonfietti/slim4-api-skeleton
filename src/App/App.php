<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

final class App
{
    public function getAppInstance()
    {
        require __DIR__ . '/../../vendor/autoload.php';
        require __DIR__ . '/DotEnv.php';
        $container = new Container();
        $app = AppFactory::create(null, new Psr11Container($container));
        require __DIR__ . '/ErrorHandler.php';
        require __DIR__ . '/Cors.php';
        require __DIR__ . '/Database.php';
        require __DIR__ . '/Services.php';
        require __DIR__ . '/Repositories.php';
        require __DIR__ . '/Routes.php';
        require __DIR__ . '/NotFound.php';

        return $app;
    }
}
