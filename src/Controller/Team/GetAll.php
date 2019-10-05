<?php declare(strict_types=1);

namespace App\Controller\Team;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $teams = $this->getTeamService()->getAllTeam();

        $payload = json_encode($teams);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
//        return $response->withJson($teams, 200);
    }
}
