<?php declare(strict_types=1);

namespace Tests\integration;

class ProductTest extends TestCase
{
    private static $id;

    public function testCreateProduct()
    {
        $params = [
                '' => '',
                
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/product');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetProducts()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/product');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetProduct()
    {
//        $response = $this->runApp('GET', '/product/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/product/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetProductNotFound()
    {
//        $response = $this->runApp('GET', '/product/123456789');
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/product/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateProduct()
    {
//        $response = $this->runApp('PUT', '/product/' . self::$id, ['' => '']);
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/product/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteProduct()
    {
//        $response = $this->runApp('DELETE', '/product/' . self::$id);
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/product/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
