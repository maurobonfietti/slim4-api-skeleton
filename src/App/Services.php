<?php declare(strict_types=1);

//use Psr\Container\ContainerInterface;

$container["team_service"] = function ($container): App\Service\TeamService {
    return new App\Service\TeamService($container["team_repository"]);
};

$container["match_service"] = function ($container): App\Service\MatchService {
    return new App\Service\MatchService($container["match_repository"]);
};

$container["player_service"] = function ($container): App\Service\PlayerService {
    return new App\Service\PlayerService($container["player_repository"]);
};

$container["users_service"] = function ($container): App\Service\UsersService {
    return new App\Service\UsersService($container["users_repository"]);
};

$container["user_service"] = function ($container): App\Service\UserService {
    return new App\Service\UserService($container["user_repository"]);
};

$container["bot_service"] = function ($container): App\Service\BotService {
    return new App\Service\BotService($container["bot_repository"]);
};

$container["movies_service"] = function ($container): App\Service\MoviesService {
    return new App\Service\MoviesService($container["movies_repository"]);
};

$container["tasks_service"] = function ($container): App\Service\TasksService {
    return new App\Service\TasksService($container["tasks_repository"]);
};

$container["teams_service"] = function ($container): App\Service\TeamsService {
    return new App\Service\TeamsService($container["teams_repository"]);
};

$container["product_service"] = function ($container): App\Service\ProductService {
    return new App\Service\ProductService($container["product_repository"]);
};

$container["notes_service"] = function ($container): App\Service\NotesService {
    return new App\Service\NotesService($container["notes_repository"]);
};
