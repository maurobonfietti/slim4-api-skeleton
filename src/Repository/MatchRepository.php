<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\MatchException;

class MatchRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetMatch(int $matchId)
    {
        $query = 'SELECT * FROM `match` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $matchId);
        $statement->execute();
        $match = $statement->fetchObject();
        if (empty($match)) {
            throw new MatchException('Match not found.', 404);
        }

        return $match;
    }

    public function getAllMatch(): array
    {
        $query = 'SELECT * FROM `match` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createMatch($match)
    {
        $query = 'INSERT INTO `match` (`id`, `match`, `created_at`, `updated_at`) VALUES (:id, :match, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $match->id);
	$statement->bindParam('match', $match->match);
	$statement->bindParam('created_at', $match->created_at);
	$statement->bindParam('updated_at', $match->updated_at);
        $statement->execute();

        return $this->checkAndGetMatch((int) $this->getDb()->lastInsertId());
    }

    public function updateMatch($match, $data)
    {
        if (isset($data->match)) { $match->match = $data->match; }
        if (isset($data->created_at)) { $match->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $match->updated_at = $data->updated_at; }

        $query = 'UPDATE `match` SET `match` = :match, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $match->id);
	$statement->bindParam('match', $match->match);
	$statement->bindParam('created_at', $match->created_at);
	$statement->bindParam('updated_at', $match->updated_at);
        $statement->execute();

        return $this->checkAndGetMatch((int) $match->id);
    }

    public function deleteMatch(int $matchId)
    {
        $query = 'DELETE FROM `match` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $matchId);
        $statement->execute();
    }
}
