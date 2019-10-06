<?php declare(strict_types=1);

namespace App\Controller\Teams;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $teamss = $this->getTeamsService()->getAllTeams();

        $payload = json_encode($teamss);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
