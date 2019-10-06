<?php declare(strict_types=1);

namespace App\Controller\Player;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $players = $this->getPlayerService()->getAllPlayer();

        $payload = json_encode($players);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
