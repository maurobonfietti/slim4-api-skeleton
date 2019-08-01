<?php declare(strict_types=1);

namespace Tests\integration;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

class BaseTestCase extends \PHPUnit\Framework\TestCase
{
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );
        $request = Request::createFromEnvironment($environment);
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }
        $baseDir = __DIR__ . '/../../';
        $envFile = $baseDir . '.env';
        if (file_exists($envFile)) {
            $dotenv = new \Dotenv\Dotenv($baseDir);
            $dotenv->load();
        }
        $settings = require $baseDir . 'src/App/Settings.php';
        $app = new App($settings);
        require $baseDir . 'src/App/Dependencies.php';
        require $baseDir . 'src/App/Services.php';
        require $baseDir . 'src/App/Repositories.php';
        require $baseDir . 'src/App/Routes.php';

        return $app->process($request, new Response());
    }
}
