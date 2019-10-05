<?php declare(strict_types=1);

//use Psr\Container\ContainerInterface;

$container["team_service"] = function ($container): App\Service\TeamService {
    return new App\Service\TeamService($container["team_repository"]);
};
