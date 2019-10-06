<?php declare(strict_types=1);

namespace App\Controller\Users;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $users = $this->getUsersService()->createUsers($input);

        $payload = json_encode($users);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
