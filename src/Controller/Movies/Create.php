<?php declare(strict_types=1);

namespace App\Controller\Movies;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $movies = $this->getMoviesService()->createMovies($input);

        $payload = json_encode($movies);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
