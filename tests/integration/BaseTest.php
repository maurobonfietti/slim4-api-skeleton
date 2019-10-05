<?php declare(strict_types=1);

namespace Tests\integration;

//use App\Test\TestCase\HttpTestTrait;
//use Tests\integration\HttpTestTrait;
//use PHPUnit\Framework\TestCase;

//use App\Application\Actions\ActionPayload;
//use App\Domain\User\UserRepository;
//use App\Domain\User\User;
//use DI\Container;
//use Tests\TestCase;

class BaseTest extends TestCase
{
//    use HttpTestTrait;

    public function testAsd1()
    {
        $app = $this->getAppInstance();
        
        $request = $this->createRequest('GET', '/status');
        $response = $app->handle($request);
//        var_dump($response->getStatusCode()); exit;
        $payload = (string) $response->getBody();
        var_dump($payload); exit;
    }

//    public function testApiHelp()
//    {
//        $request = $this->createRequest('GET', '/hello/john');
//        $response = $this->request($request);
//        var_dump($response->getStatusCode()); exit;
//    }

//    public function testApiHelp()
//    {
//        $response = $this->runApp('GET', '/');
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertStringContainsString('api', (string) $response->getBody());
//        $this->assertStringContainsString('version', (string) $response->getBody());
//        $this->assertStringContainsString('time', (string) $response->getBody());
//        $this->assertStringNotContainsString('error', (string) $response->getBody());
//    }
//
//    public function testStatus()
//    {
//        $response = $this->runApp('GET', '/status');
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertStringContainsString('api', (string) $response->getBody());
//        $this->assertStringContainsString('version', (string) $response->getBody());
//        $this->assertStringContainsString('time', (string) $response->getBody());
//        $this->assertStringContainsString('database', (string) $response->getBody());
//        $this->assertStringNotContainsString('error', (string) $response->getBody());
//        $this->assertStringNotContainsString('failed', (string) $response->getBody());
//        $this->assertStringNotContainsString('PDOException', (string) $response->getBody());
//    }
}
