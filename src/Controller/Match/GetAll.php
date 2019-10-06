<?php declare(strict_types=1);

namespace App\Controller\Match;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $matchs = $this->getMatchService()->getAllMatch();

        $payload = json_encode($matchs);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
