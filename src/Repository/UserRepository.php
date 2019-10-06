<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\UserException;

class UserRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetUser(int $userId)
    {
        $query = 'SELECT * FROM `user` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException('User not found.', 404);
        }

        return $user;
    }

    public function getAllUser(): array
    {
        $query = 'SELECT * FROM `user` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createUser($user)
    {
        $query = 'INSERT INTO `user` (`id`, `name`, `email`, `picture`, `nickname`, `language`, `created_at`, `email_verified`, `deleted`, `state`, `countryId`, `superadmin`, `last_login`) VALUES (:id, :name, :email, :picture, :nickname, :language, :created_at, :email_verified, :deleted, :state, :countryId, :superadmin, :last_login)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user->id);
	$statement->bindParam('name', $user->name);
	$statement->bindParam('email', $user->email);
	$statement->bindParam('picture', $user->picture);
	$statement->bindParam('nickname', $user->nickname);
	$statement->bindParam('language', $user->language);
	$statement->bindParam('created_at', $user->created_at);
	$statement->bindParam('email_verified', $user->email_verified);
	$statement->bindParam('deleted', $user->deleted);
	$statement->bindParam('state', $user->state);
	$statement->bindParam('countryId', $user->countryId);
	$statement->bindParam('superadmin', $user->superadmin);
	$statement->bindParam('last_login', $user->last_login);
        $statement->execute();

        return $this->checkAndGetUser((int) $this->getDb()->lastInsertId());
    }

    public function updateUser($user, $data)
    {
        if (isset($data->name)) { $user->name = $data->name; }
        if (isset($data->email)) { $user->email = $data->email; }
        if (isset($data->picture)) { $user->picture = $data->picture; }
        if (isset($data->nickname)) { $user->nickname = $data->nickname; }
        if (isset($data->language)) { $user->language = $data->language; }
        if (isset($data->created_at)) { $user->created_at = $data->created_at; }
        if (isset($data->email_verified)) { $user->email_verified = $data->email_verified; }
        if (isset($data->deleted)) { $user->deleted = $data->deleted; }
        if (isset($data->state)) { $user->state = $data->state; }
        if (isset($data->countryId)) { $user->countryId = $data->countryId; }
        if (isset($data->superadmin)) { $user->superadmin = $data->superadmin; }
        if (isset($data->last_login)) { $user->last_login = $data->last_login; }

        $query = 'UPDATE `user` SET `name` = :name, `email` = :email, `picture` = :picture, `nickname` = :nickname, `language` = :language, `created_at` = :created_at, `email_verified` = :email_verified, `deleted` = :deleted, `state` = :state, `countryId` = :countryId, `superadmin` = :superadmin, `last_login` = :last_login WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user->id);
	$statement->bindParam('name', $user->name);
	$statement->bindParam('email', $user->email);
	$statement->bindParam('picture', $user->picture);
	$statement->bindParam('nickname', $user->nickname);
	$statement->bindParam('language', $user->language);
	$statement->bindParam('created_at', $user->created_at);
	$statement->bindParam('email_verified', $user->email_verified);
	$statement->bindParam('deleted', $user->deleted);
	$statement->bindParam('state', $user->state);
	$statement->bindParam('countryId', $user->countryId);
	$statement->bindParam('superadmin', $user->superadmin);
	$statement->bindParam('last_login', $user->last_login);
        $statement->execute();

        return $this->checkAndGetUser((int) $user->id);
    }

    public function deleteUser(int $userId)
    {
        $query = 'DELETE FROM `user` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
    }
}
