<?php

declare(strict_types=1);

$path = $_SERVER['SLIM_BASE_PATH'] ?? '';
$app->setBasePath($path);
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$displayError = filter_var(
    $_SERVER['DISPLAY_ERROR_DETAILS'] ?? false,
    FILTER_VALIDATE_BOOLEAN
);
$errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
