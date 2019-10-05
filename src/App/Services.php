<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;

//$container = $app->getContainer();

$container["team_service"] = function ($container): App\Service\TeamService {
    return new App\Service\TeamService($container["team_repository"]);
//    return new App\Service\TeamService($container->get("team_repository"));
};
