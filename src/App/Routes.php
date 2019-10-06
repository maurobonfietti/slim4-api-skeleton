<?php declare(strict_types=1);

$app->get('/', 'App\Controller\Base\BaseController:getHelp');
$app->get('/status', 'App\Controller\Base\BaseController:getStatus');

//$app->group("/team", function () use ($app) {
    $app->get("/team", "App\Controller\Team\GetAll");
    $app->get("/team/[{id}]", "App\Controller\Team\GetOne");
    $app->post("/team", "App\Controller\Team\Create");
    $app->put("/team/[{id}]", "App\Controller\Team\Update");
    $app->delete("/team/[{id}]", "App\Controller\Team\Delete");
//});

$app->get("/match", "App\Controller\Match\GetAll");
$app->get("/match/[{id}]", "App\Controller\Match\GetOne");
$app->post("/match", "App\Controller\Match\Create");
$app->put("/match/[{id}]", "App\Controller\Match\Update");
$app->delete("/match/[{id}]", "App\Controller\Match\Delete");

$app->get("/player", "App\Controller\Player\GetAll");
$app->get("/player/[{id}]", "App\Controller\Player\GetOne");
$app->post("/player", "App\Controller\Player\Create");
$app->put("/player/[{id}]", "App\Controller\Player\Update");
$app->delete("/player/[{id}]", "App\Controller\Player\Delete");

$app->get("/users", "App\Controller\Users\GetAll");
$app->get("/users/[{id}]", "App\Controller\Users\GetOne");
$app->post("/users", "App\Controller\Users\Create");
$app->put("/users/[{id}]", "App\Controller\Users\Update");
$app->delete("/users/[{id}]", "App\Controller\Users\Delete");

$app->get("/user", "App\Controller\User\GetAll");
$app->get("/user/[{id}]", "App\Controller\User\GetOne");
$app->post("/user", "App\Controller\User\Create");
$app->put("/user/[{id}]", "App\Controller\User\Update");
$app->delete("/user/[{id}]", "App\Controller\User\Delete");

$app->get("/bot", "App\Controller\Bot\GetAll");
$app->get("/bot/[{id}]", "App\Controller\Bot\GetOne");
$app->post("/bot", "App\Controller\Bot\Create");
$app->put("/bot/[{id}]", "App\Controller\Bot\Update");
$app->delete("/bot/[{id}]", "App\Controller\Bot\Delete");

$app->get("/movies", "App\Controller\Movies\GetAll");
$app->get("/movies/[{id}]", "App\Controller\Movies\GetOne");
$app->post("/movies", "App\Controller\Movies\Create");
$app->put("/movies/[{id}]", "App\Controller\Movies\Update");
$app->delete("/movies/[{id}]", "App\Controller\Movies\Delete");

$app->get("/tasks", "App\Controller\Tasks\GetAll");
$app->get("/tasks/[{id}]", "App\Controller\Tasks\GetOne");
$app->post("/tasks", "App\Controller\Tasks\Create");
$app->put("/tasks/[{id}]", "App\Controller\Tasks\Update");
$app->delete("/tasks/[{id}]", "App\Controller\Tasks\Delete");

$app->get("/teams", "App\Controller\Teams\GetAll");
$app->get("/teams/[{id}]", "App\Controller\Teams\GetOne");
$app->post("/teams", "App\Controller\Teams\Create");
$app->put("/teams/[{id}]", "App\Controller\Teams\Update");
$app->delete("/teams/[{id}]", "App\Controller\Teams\Delete");

$app->get("/product", "App\Controller\Product\GetAll");
$app->get("/product/[{id}]", "App\Controller\Product\GetOne");
$app->post("/product", "App\Controller\Product\Create");
$app->put("/product/[{id}]", "App\Controller\Product\Update");
$app->delete("/product/[{id}]", "App\Controller\Product\Delete");

$app->get("/notes", "App\Controller\Notes\GetAll");
$app->get("/notes/[{id}]", "App\Controller\Notes\GetOne");
$app->post("/notes", "App\Controller\Notes\Create");
$app->put("/notes/[{id}]", "App\Controller\Notes\Update");
$app->delete("/notes/[{id}]", "App\Controller\Notes\Delete");
