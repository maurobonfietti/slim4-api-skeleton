<?php declare(strict_types=1);

use App\Handler\ApiError;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['errorHandler'] = function (): ApiError {
    return new ApiError;
};
