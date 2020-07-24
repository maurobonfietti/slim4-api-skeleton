<?php

declare(strict_types=1);

$path = getenv('SLIM_BASE_PATH') ? getenv('SLIM_BASE_PATH') : '';
$app->setBasePath($path);
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$displayError = filter_var(
    getenv('DISPLAY_ERROR_DETAILS'),
    FILTER_VALIDATE_BOOLEAN
);
$errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
