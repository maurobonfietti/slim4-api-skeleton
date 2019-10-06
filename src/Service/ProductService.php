<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ProductException;
use App\Repository\ProductRepository;

class ProductService extends BaseService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    protected function checkAndGetProduct(int $productId)
    {
        return $this->productRepository->checkAndGetProduct($productId);
    }

    public function getAllProduct(): array
    {
        return $this->productRepository->getAllProduct();
    }

    public function getProduct(int $productId)
    {
        return $this->checkAndGetProduct($productId);
    }

    public function createProduct($input)
    {
        $product = json_decode(json_encode($input), false);

        return $this->productRepository->createProduct($product);
    }

    public function updateProduct(array $input, int $productId)
    {
        $product = $this->checkAndGetProduct($productId);
        $data = json_decode(json_encode($input), false);

        return $this->productRepository->updateProduct($product, $data);
    }

    public function deleteProduct(int $productId)
    {
        $this->checkAndGetProduct($productId);
        $this->productRepository->deleteProduct($productId);
    }
}
