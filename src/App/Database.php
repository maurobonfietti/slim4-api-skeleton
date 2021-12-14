<?php

declare(strict_types=1);

$container['db'] = static function (): PDO {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;port=%s;charset=utf8',
        $_SERVER['DB_HOST'],
        $_SERVER['DB_NAME'],
        $_SERVER['DB_PORT']
    );
    $pdo = new PDO($dsn, $_SERVER['DB_USER'], $_SERVER['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};
