<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\MoviesException;

class MoviesRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetMovies(int $moviesId)
    {
        $query = 'SELECT * FROM `movies` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $moviesId);
        $statement->execute();
        $movies = $statement->fetchObject();
        if (empty($movies)) {
            throw new MoviesException('Movies not found.', 404);
        }

        return $movies;
    }

    public function getAllMovies(): array
    {
        $query = 'SELECT * FROM `movies` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createMovies($movies)
    {
        $query = 'INSERT INTO `movies` (`id`, `title`, `budget`, `revenue`, `imdb`, `language`) VALUES (:id, :title, :budget, :revenue, :imdb, :language)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $movies->id);
	$statement->bindParam('title', $movies->title);
	$statement->bindParam('budget', $movies->budget);
	$statement->bindParam('revenue', $movies->revenue);
	$statement->bindParam('imdb', $movies->imdb);
	$statement->bindParam('language', $movies->language);
        $statement->execute();

        return $this->checkAndGetMovies((int) $this->getDb()->lastInsertId());
    }

    public function updateMovies($movies, $data)
    {
        if (isset($data->title)) { $movies->title = $data->title; }
        if (isset($data->budget)) { $movies->budget = $data->budget; }
        if (isset($data->revenue)) { $movies->revenue = $data->revenue; }
        if (isset($data->imdb)) { $movies->imdb = $data->imdb; }
        if (isset($data->language)) { $movies->language = $data->language; }

        $query = 'UPDATE `movies` SET `title` = :title, `budget` = :budget, `revenue` = :revenue, `imdb` = :imdb, `language` = :language WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $movies->id);
	$statement->bindParam('title', $movies->title);
	$statement->bindParam('budget', $movies->budget);
	$statement->bindParam('revenue', $movies->revenue);
	$statement->bindParam('imdb', $movies->imdb);
	$statement->bindParam('language', $movies->language);
        $statement->execute();

        return $this->checkAndGetMovies((int) $movies->id);
    }

    public function deleteMovies(int $moviesId)
    {
        $query = 'DELETE FROM `movies` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $moviesId);
        $statement->execute();
    }
}
