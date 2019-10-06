<?php declare(strict_types=1);

namespace App\Controller\Player;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $player = $this->getPlayerService()->createPlayer($input);

        $payload = json_encode($player);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
