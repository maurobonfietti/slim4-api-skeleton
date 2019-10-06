<?php declare(strict_types=1);

namespace App\Controller\Product;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $products = $this->getProductService()->getAllProduct();

        $payload = json_encode($products);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
