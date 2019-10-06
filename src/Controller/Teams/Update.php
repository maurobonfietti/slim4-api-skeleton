<?php declare(strict_types=1);

namespace App\Controller\Teams;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $teams = $this->getTeamsService()->updateTeams($input, (int) $args['id']);

        $payload = json_encode($teams);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
