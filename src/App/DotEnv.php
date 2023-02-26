<?php

declare(strict_types=1);

$baseDir = __DIR__ . '/../../';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable($baseDir);
if (file_exists($baseDir . '.env')) {
    $dotenv->load();
}
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
