<?php declare(strict_types=1);

$app->get('/', 'App\Controller\Base\DefaultController:getHelp');
$app->get('/status', 'App\Controller\Base\DefaultController:getStatus');
