<?php declare(strict_types=1);

namespace App\Controller\Player;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $player = $this->getPlayerService()->getPlayer((int) $args['id']);

        $payload = json_encode($player);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
