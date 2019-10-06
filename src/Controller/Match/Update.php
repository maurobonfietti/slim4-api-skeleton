<?php declare(strict_types=1);

namespace App\Controller\Match;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $match = $this->getMatchService()->updateMatch($input, (int) $args['id']);

        $payload = json_encode($match);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
