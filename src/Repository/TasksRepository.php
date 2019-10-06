<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\TasksException;

class TasksRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetTasks(int $tasksId)
    {
        $query = 'SELECT * FROM `tasks` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $tasksId);
        $statement->execute();
        $tasks = $statement->fetchObject();
        if (empty($tasks)) {
            throw new TasksException('Tasks not found.', 404);
        }

        return $tasks;
    }

    public function getAllTasks(): array
    {
        $query = 'SELECT * FROM `tasks` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createTasks($tasks)
    {
        $query = 'INSERT INTO `tasks` (`id`, `name`, `description`, `status`, `userId`, `created_at`, `updated_at`) VALUES (:id, :name, :description, :status, :userId, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $tasks->id);
	$statement->bindParam('name', $tasks->name);
	$statement->bindParam('description', $tasks->description);
	$statement->bindParam('status', $tasks->status);
	$statement->bindParam('userId', $tasks->userId);
	$statement->bindParam('created_at', $tasks->created_at);
	$statement->bindParam('updated_at', $tasks->updated_at);
        $statement->execute();

        return $this->checkAndGetTasks((int) $this->getDb()->lastInsertId());
    }

    public function updateTasks($tasks, $data)
    {
        if (isset($data->name)) { $tasks->name = $data->name; }
        if (isset($data->description)) { $tasks->description = $data->description; }
        if (isset($data->status)) { $tasks->status = $data->status; }
        if (isset($data->userId)) { $tasks->userId = $data->userId; }
        if (isset($data->created_at)) { $tasks->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $tasks->updated_at = $data->updated_at; }

        $query = 'UPDATE `tasks` SET `name` = :name, `description` = :description, `status` = :status, `userId` = :userId, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $tasks->id);
	$statement->bindParam('name', $tasks->name);
	$statement->bindParam('description', $tasks->description);
	$statement->bindParam('status', $tasks->status);
	$statement->bindParam('userId', $tasks->userId);
	$statement->bindParam('created_at', $tasks->created_at);
	$statement->bindParam('updated_at', $tasks->updated_at);
        $statement->execute();

        return $this->checkAndGetTasks((int) $tasks->id);
    }

    public function deleteTasks(int $tasksId)
    {
        $query = 'DELETE FROM `tasks` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $tasksId);
        $statement->execute();
    }
}
