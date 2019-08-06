<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\ObjectbaseException;

class ObjectbaseRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetObjectbase(int $objectbaseId)
    {
        $query = 'SELECT * FROM `objectbase` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $objectbaseId);
        $statement->execute();
        $objectbase = $statement->fetchObject();
        if (empty($objectbase)) {
            throw new ObjectbaseException('Objectbase not found.', 404);
        }

        return $objectbase;
    }

    public function getAllObjectbase(): array
    {
        $query = 'SELECT * FROM `objectbase` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createObjectbase($objectbase)
    {
        #ppp
    }

    public function updateObjectbase($objectbase, $data)
    {
        #uuu
    }

    public function deleteObjectbase(int $objectbaseId): string
    {
        $query = 'DELETE FROM `objectbase` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $objectbaseId);
        $statement->execute();

        return 'The objectbase was deleted.';
    }
}
