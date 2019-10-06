<?php declare(strict_types=1);

namespace App\Controller\Teams;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $teams = $this->getTeamsService()->createTeams($input);

        $payload = json_encode($teams);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
