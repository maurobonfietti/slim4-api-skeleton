<?php declare(strict_types=1);

namespace App\Controller\Users;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $users = $this->getUsersService()->getUsers((int) $args['id']);

        $payload = json_encode($users);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
