<?php declare(strict_types=1);

namespace App\Controller\User;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $users = $this->getUserService()->getAllUser();

        $payload = json_encode($users);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
