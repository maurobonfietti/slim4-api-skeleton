<?php declare(strict_types=1);

namespace App\Controller\Team;

use Slim\Http\Request;
use Slim\Http\Response;

class Delete extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $team = $this->getTeamService()->deleteTeam((int) $args['id']);

//        return $response->withJson($team, 204);
        $payload = json_encode($team);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
