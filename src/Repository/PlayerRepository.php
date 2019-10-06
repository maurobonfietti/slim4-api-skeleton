<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\PlayerException;

class PlayerRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetPlayer(int $playerId)
    {
        $query = 'SELECT * FROM `player` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
        $player = $statement->fetchObject();
        if (empty($player)) {
            throw new PlayerException('Player not found.', 404);
        }

        return $player;
    }

    public function getAllPlayer(): array
    {
        $query = 'SELECT * FROM `player` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createPlayer($player)
    {
        $query = 'INSERT INTO `player` (`id`, `name`, `won`, `drawn`, `lost`, `created_at`, `updated_at`) VALUES (:id, :name, :won, :drawn, :lost, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $player->id);
	$statement->bindParam('name', $player->name);
	$statement->bindParam('won', $player->won);
	$statement->bindParam('drawn', $player->drawn);
	$statement->bindParam('lost', $player->lost);
	$statement->bindParam('created_at', $player->created_at);
	$statement->bindParam('updated_at', $player->updated_at);
        $statement->execute();

        return $this->checkAndGetPlayer((int) $this->getDb()->lastInsertId());
    }

    public function updatePlayer($player, $data)
    {
        if (isset($data->name)) { $player->name = $data->name; }
        if (isset($data->won)) { $player->won = $data->won; }
        if (isset($data->drawn)) { $player->drawn = $data->drawn; }
        if (isset($data->lost)) { $player->lost = $data->lost; }
        if (isset($data->created_at)) { $player->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $player->updated_at = $data->updated_at; }

        $query = 'UPDATE `player` SET `name` = :name, `won` = :won, `drawn` = :drawn, `lost` = :lost, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $player->id);
	$statement->bindParam('name', $player->name);
	$statement->bindParam('won', $player->won);
	$statement->bindParam('drawn', $player->drawn);
	$statement->bindParam('lost', $player->lost);
	$statement->bindParam('created_at', $player->created_at);
	$statement->bindParam('updated_at', $player->updated_at);
        $statement->execute();

        return $this->checkAndGetPlayer((int) $player->id);
    }

    public function deletePlayer(int $playerId)
    {
        $query = 'DELETE FROM `player` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $playerId);
        $statement->execute();
    }
}
