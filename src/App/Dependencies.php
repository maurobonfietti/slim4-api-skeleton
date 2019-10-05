<?php declare(strict_types=1);

use App\Handler\ApiError;
use Psr\Container\ContainerInterface;

use Pimple\Container;

//$ccc = $app->getContainer();
//var_dump($ccc); exit;

//$container = $app->getContainer();
//
$container['db'] = function (Container $c): PDO {
//    var_dump($c['settings']); exit;
//    $db = $c->get('settings')['db'];
    $db = $c['settings']['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']);
    $pdo = new PDO($database, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};
//
//$container['errorHandler'] = function (): ApiError {
//    return new ApiError;
//};

//return function (Container $container) {
//    $container[HomePageHandler::class] = static function ($c) {
//        return new HomePageHandler($c['settings']['default_name']);
//    };
//};