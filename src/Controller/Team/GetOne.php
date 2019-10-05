<?php declare(strict_types=1);

namespace App\Controller\Team;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $team = $this->getTeamService()->getTeam((int) $args['id']);

        $payload = json_encode($team);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
