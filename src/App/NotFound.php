<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return static function (App $app): void {
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function (Request $request): void {
            throw new Slim\Exception\HttpNotFoundException($request);
        }
    );
};
