<?php declare(strict_types=1);

namespace App\Controller\Team;

use Slim\Http\Request;
use Slim\Http\Response;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $team = $this->getTeamService()->createTeam($input);

        $payload = json_encode($team);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
//        return $response->withJson($team, 201);
    }
}
