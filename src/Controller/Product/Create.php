<?php declare(strict_types=1);

namespace App\Controller\Product;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $product = $this->getProductService()->createProduct($input);

        $payload = json_encode($product);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
