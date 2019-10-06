<?php declare(strict_types=1);

namespace App\Controller\Movies;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $movies = $this->getMoviesService()->updateMovies($input, (int) $args['id']);

        $payload = json_encode($movies);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
