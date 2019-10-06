<?php declare(strict_types=1);

//use Psr\Container\ContainerInterface;

$container["team_repository"] = function ($container): App\Repository\TeamRepository {
    return new App\Repository\TeamRepository($container["db"]);
};

$container["match_repository"] = function ($container): App\Repository\MatchRepository {
    return new App\Repository\MatchRepository($container["db"]);
};

$container["player_repository"] = function ($container): App\Repository\PlayerRepository {
    return new App\Repository\PlayerRepository($container["db"]);
};

$container["users_repository"] = function ($container): App\Repository\UsersRepository {
    return new App\Repository\UsersRepository($container["db"]);
};

$container["user_repository"] = function ($container): App\Repository\UserRepository {
    return new App\Repository\UserRepository($container["db"]);
};

$container["bot_repository"] = function ($container): App\Repository\BotRepository {
    return new App\Repository\BotRepository($container["db"]);
};

$container["movies_repository"] = function ($container): App\Repository\MoviesRepository {
    return new App\Repository\MoviesRepository($container["db"]);
};

$container["tasks_repository"] = function ($container): App\Repository\TasksRepository {
    return new App\Repository\TasksRepository($container["db"]);
};

$container["teams_repository"] = function ($container): App\Repository\TeamsRepository {
    return new App\Repository\TeamsRepository($container["db"]);
};

$container["product_repository"] = function ($container): App\Repository\ProductRepository {
    return new App\Repository\ProductRepository($container["db"]);
};

$container["notes_repository"] = function ($container): App\Repository\NotesRepository {
    return new App\Repository\NotesRepository($container["db"]);
};
