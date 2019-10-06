<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\ProductException;

class ProductRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetProduct(int $productId)
    {
        $query = 'SELECT * FROM `product` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $productId);
        $statement->execute();
        $product = $statement->fetchObject();
        if (empty($product)) {
            throw new ProductException('Product not found.', 404);
        }

        return $product;
    }

    public function getAllProduct(): array
    {
        $query = 'SELECT * FROM `product` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createProduct($product)
    {
        $query = 'INSERT INTO `product` (`id`, `product`) VALUES (:id, :product)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $product->id);
	$statement->bindParam('product', $product->product);
        $statement->execute();

        return $this->checkAndGetProduct((int) $this->getDb()->lastInsertId());
    }

    public function updateProduct($product, $data)
    {
        if (isset($data->product)) { $product->product = $data->product; }

        $query = 'UPDATE `product` SET `product` = :product WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $product->id);
	$statement->bindParam('product', $product->product);
        $statement->execute();

        return $this->checkAndGetProduct((int) $product->id);
    }

    public function deleteProduct(int $productId)
    {
        $query = 'DELETE FROM `product` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $productId);
        $statement->execute();
    }
}
