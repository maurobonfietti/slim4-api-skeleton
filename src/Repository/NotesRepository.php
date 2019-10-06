<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\NotesException;

class NotesRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetNotes(int $notesId)
    {
        $query = 'SELECT * FROM `notes` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notesId);
        $statement->execute();
        $notes = $statement->fetchObject();
        if (empty($notes)) {
            throw new NotesException('Notes not found.', 404);
        }

        return $notes;
    }

    public function getAllNotes(): array
    {
        $query = 'SELECT * FROM `notes` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createNotes($notes)
    {
        $query = 'INSERT INTO `notes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES (:id, :name, :description, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notes->id);
	$statement->bindParam('name', $notes->name);
	$statement->bindParam('description', $notes->description);
	$statement->bindParam('created_at', $notes->created_at);
	$statement->bindParam('updated_at', $notes->updated_at);
        $statement->execute();

        return $this->checkAndGetNotes((int) $this->getDb()->lastInsertId());
    }

    public function updateNotes($notes, $data)
    {
        if (isset($data->name)) { $notes->name = $data->name; }
        if (isset($data->description)) { $notes->description = $data->description; }
        if (isset($data->created_at)) { $notes->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $notes->updated_at = $data->updated_at; }

        $query = 'UPDATE `notes` SET `name` = :name, `description` = :description, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notes->id);
	$statement->bindParam('name', $notes->name);
	$statement->bindParam('description', $notes->description);
	$statement->bindParam('created_at', $notes->created_at);
	$statement->bindParam('updated_at', $notes->updated_at);
        $statement->execute();

        return $this->checkAndGetNotes((int) $notes->id);
    }

    public function deleteNotes(int $notesId)
    {
        $query = 'DELETE FROM `notes` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notesId);
        $statement->execute();
    }
}
