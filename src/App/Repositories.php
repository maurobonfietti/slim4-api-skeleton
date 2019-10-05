<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;

$container["team_repository"] = function ($container): App\Repository\TeamRepository {
    return new App\Repository\TeamRepository($container["db"]);
};
