<?php

declare(strict_types=1);

require __DIR__ . '/../src/App/App.php';

$app = new App();
$application = $app->getAppInstance();
$application->run();
