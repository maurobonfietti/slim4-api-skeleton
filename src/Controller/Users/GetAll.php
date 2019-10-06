<?php declare(strict_types=1);

namespace App\Controller\Users;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $userss = $this->getUsersService()->getAllUsers();

        $payload = json_encode($userss);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
