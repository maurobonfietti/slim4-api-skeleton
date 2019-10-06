<?php declare(strict_types=1);

namespace App\Controller\Product;

use App\Service\ProductService;

abstract class Base
{
    protected $container;

    protected $productService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getProductService(): ProductService
    {
        return $this->container->get('product_service');
    }
}
