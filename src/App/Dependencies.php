<?php declare(strict_types=1);

use Pimple\Container;

$container['db'] = function (Container $c): PDO {
    $db = $c['settings']['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']);
    $pdo = new PDO($database, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};
