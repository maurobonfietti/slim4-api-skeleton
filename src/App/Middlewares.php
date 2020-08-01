<?php

declare(strict_types=1);

$path = isset($_SERVER['SLIM_BASE_PATH']) ? $_SERVER['SLIM_BASE_PATH'] : '';
$app->setBasePath($path);
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$displayError = filter_var(
    isset($_SERVER['DISPLAY_ERROR_DETAILS']) ? $_SERVER['DISPLAY_ERROR_DETAILS'] : false,
    FILTER_VALIDATE_BOOLEAN
);
$errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
