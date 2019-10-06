<?php declare(strict_types=1);

namespace App\Controller\Product;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $product = $this->getProductService()->getProduct((int) $args['id']);

        $payload = json_encode($product);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
