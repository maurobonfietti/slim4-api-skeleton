<?php declare(strict_types=1);

namespace App\Controller\User;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $user = $this->getUserService()->getUser((int) $args['id']);

        $payload = json_encode($user);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
