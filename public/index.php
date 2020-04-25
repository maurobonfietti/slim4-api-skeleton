<?php

declare(strict_types=1);

require __DIR__ . '/../src/App/App.php';
$app = new App();
$app = $app->getAppInstance();
$app->run();
