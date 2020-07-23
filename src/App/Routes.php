<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get("/restaurantes", "App\Controller\Restaurantes\GetAll");
$app->post("/restaurantes", "App\Controller\Restaurantes\Create");
$app->get("/restaurantes/{id}", "App\Controller\Restaurantes\GetOne");
$app->put("/restaurantes/{id}", "App\Controller\Restaurantes\Update");
$app->delete("/restaurantes/{id}", "App\Controller\Restaurantes\Delete");
