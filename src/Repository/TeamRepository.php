<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\TeamException;

class TeamRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetTeam(int $teamId)
    {
        $query = 'SELECT * FROM `team` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamId);
        $statement->execute();
        $team = $statement->fetchObject();
        if (empty($team)) {
            throw new TeamException('Team not found.', 404);
        }

        return $team;
    }

    public function getAllTeam(): array
    {
        $query = 'SELECT * FROM `team` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createTeam($team)
    {
        $query = 'INSERT INTO `team` (`id`, `name`, `stadium`, `capacity`) VALUES (:id, :name, :stadium, :capacity)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $team->id);
        $statement->bindParam('name', $team->name);
        $statement->bindParam('stadium', $team->stadium);
        $statement->bindParam('capacity', $team->capacity);
        $statement->execute();

        return $this->checkAndGetTeam((int) $this->getDb()->lastInsertId());
    }

    public function updateTeam($team, $data)
    {
        if (isset($data->name)) {
            $team->name = $data->name;
        }
        if (isset($data->stadium)) {
            $team->stadium = $data->stadium;
        }
        if (isset($data->capacity)) {
            $team->capacity = $data->capacity;
        }

        $query = 'UPDATE `team` SET `name` = :name, `stadium` = :stadium, `capacity` = :capacity WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $team->id);
        $statement->bindParam('name', $team->name);
        $statement->bindParam('stadium', $team->stadium);
        $statement->bindParam('capacity', $team->capacity);
        $statement->execute();

        return $this->checkAndGetTeam((int) $team->id);
    }

    public function deleteTeam(int $teamId): string
    {
        $query = 'DELETE FROM `team` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $teamId);
        $statement->execute();

        return 'The team was deleted.';
    }
}
