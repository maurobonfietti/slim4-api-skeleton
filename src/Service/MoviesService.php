<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\MoviesException;
use App\Repository\MoviesRepository;

class MoviesService extends BaseService
{
    protected $moviesRepository;

    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }

    protected function checkAndGetMovies(int $moviesId)
    {
        return $this->moviesRepository->checkAndGetMovies($moviesId);
    }

    public function getAllMovies(): array
    {
        return $this->moviesRepository->getAllMovies();
    }

    public function getMovies(int $moviesId)
    {
        return $this->checkAndGetMovies($moviesId);
    }

    public function createMovies($input)
    {
        $movies = json_decode(json_encode($input), false);

        return $this->moviesRepository->createMovies($movies);
    }

    public function updateMovies(array $input, int $moviesId)
    {
        $movies = $this->checkAndGetMovies($moviesId);
        $data = json_decode(json_encode($input), false);

        return $this->moviesRepository->updateMovies($movies, $data);
    }

    public function deleteMovies(int $moviesId)
    {
        $this->checkAndGetMovies($moviesId);
        $this->moviesRepository->deleteMovies($moviesId);
    }
}
