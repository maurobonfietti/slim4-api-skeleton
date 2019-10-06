<?php declare(strict_types=1);

namespace App\Controller\Movies;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $moviess = $this->getMoviesService()->getAllMovies();

        $payload = json_encode($moviess);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
