<?php declare(strict_types=1);

namespace App\Controller\Movies;

use App\Service\MoviesService;

abstract class Base
{
    protected $container;

    protected $moviesService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getMoviesService(): MoviesService
    {
        return $this->container->get('movies_service');
    }
}
