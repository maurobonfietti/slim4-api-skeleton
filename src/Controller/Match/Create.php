<?php declare(strict_types=1);

namespace App\Controller\Match;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $match = $this->getMatchService()->createMatch($input);

        $payload = json_encode($match);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
