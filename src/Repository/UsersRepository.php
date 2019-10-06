<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\UsersException;

class UsersRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetUsers(int $usersId)
    {
        $query = 'SELECT * FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
        $users = $statement->fetchObject();
        if (empty($users)) {
            throw new UsersException('Users not found.', 404);
        }

        return $users;
    }

    public function getAllUsers(): array
    {
        $query = 'SELECT * FROM `users` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createUsers($users)
    {
        $query = 'INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES (:id, :name, :email, :password, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
	$statement->bindParam('name', $users->name);
	$statement->bindParam('email', $users->email);
	$statement->bindParam('password', $users->password);
	$statement->bindParam('created_at', $users->created_at);
	$statement->bindParam('updated_at', $users->updated_at);
        $statement->execute();

        return $this->checkAndGetUsers((int) $this->getDb()->lastInsertId());
    }

    public function updateUsers($users, $data)
    {
        if (isset($data->name)) { $users->name = $data->name; }
        if (isset($data->email)) { $users->email = $data->email; }
        if (isset($data->password)) { $users->password = $data->password; }
        if (isset($data->created_at)) { $users->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $users->updated_at = $data->updated_at; }

        $query = 'UPDATE `users` SET `name` = :name, `email` = :email, `password` = :password, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
	$statement->bindParam('name', $users->name);
	$statement->bindParam('email', $users->email);
	$statement->bindParam('password', $users->password);
	$statement->bindParam('created_at', $users->created_at);
	$statement->bindParam('updated_at', $users->updated_at);
        $statement->execute();

        return $this->checkAndGetUsers((int) $users->id);
    }

    public function deleteUsers(int $usersId)
    {
        $query = 'DELETE FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
    }
}
