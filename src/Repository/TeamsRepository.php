<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\TeamsException;

class TeamsRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetTeams(int $teamsId)
    {
        $query = 'SELECT * FROM `teams` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamsId);
        $statement->execute();
        $teams = $statement->fetchObject();
        if (empty($teams)) {
            throw new TeamsException('Teams not found.', 404);
        }

        return $teams;
    }

    public function getAllTeams(): array
    {
        $query = 'SELECT * FROM `teams` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createTeams($teams)
    {
        $query = 'INSERT INTO `teams` (`id`, `name`) VALUES (:id, :name)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teams->id);
	$statement->bindParam('name', $teams->name);
        $statement->execute();

        return $this->checkAndGetTeams((int) $this->getDb()->lastInsertId());
    }

    public function updateTeams($teams, $data)
    {
        if (isset($data->name)) { $teams->name = $data->name; }

        $query = 'UPDATE `teams` SET `name` = :name WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teams->id);
	$statement->bindParam('name', $teams->name);
        $statement->execute();

        return $this->checkAndGetTeams((int) $teams->id);
    }

    public function deleteTeams(int $teamsId)
    {
        $query = 'DELETE FROM `teams` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamsId);
        $statement->execute();
    }
}
