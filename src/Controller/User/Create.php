<?php declare(strict_types=1);

namespace App\Controller\User;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $user = $this->getUserService()->createUser($input);

        $payload = json_encode($user);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
