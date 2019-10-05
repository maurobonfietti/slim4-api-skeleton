<?php declare(strict_types=1);

namespace App\Controller\Team;

use Slim\Http\Request;
use Slim\Http\Response;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $team = $this->getTeamService()->updateTeam($input, (int) $args['id']);

        $payload = json_encode($team);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
//        return $response->withJson($team, 200);
    }
}
