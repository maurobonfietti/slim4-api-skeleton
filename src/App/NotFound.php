<?php

declare(strict_types=1);

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}',
    function ($request): void {
        throw new Slim\Exception\HttpNotFoundException($request);
    }
);
