<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;

//$container = $app->getContainer();

$container["team_repository"] = function ($container): App\Repository\TeamRepository {
    return new App\Repository\TeamRepository($container["db"]);
//    return new App\Repository\TeamRepository($container->get("db"));
};
