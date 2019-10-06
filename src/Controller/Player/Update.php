<?php declare(strict_types=1);

namespace App\Controller\Player;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $player = $this->getPlayerService()->updatePlayer($input, (int) $args['id']);

        $payload = json_encode($player);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
