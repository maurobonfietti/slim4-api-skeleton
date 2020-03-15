<?php

require __DIR__ . '/../src/App/App.php';
$app = new App();
$app = $app->getAppInstance();
$app->run();
