<?php

declare(strict_types=1);

final class App
{
    public function getAppInstance()
    {
        require __DIR__ . '/../../vendor/autoload.php';
        require __DIR__ . '/DotEnv.php';
        require __DIR__ . '/Application.php';
        require __DIR__ . '/ErrorHandler.php';
        require __DIR__ . '/Cors.php';
        require __DIR__ . '/Database.php';
        require __DIR__ . '/Services.php';
        require __DIR__ . '/Repositories.php';
        require __DIR__ . '/Routes.php';
        require __DIR__ . '/NotFound.php';

        return $app;
    }
}
