<?php declare(strict_types=1);

namespace App\Controller\Users;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $users = $this->getUsersService()->updateUsers($input, (int) $args['id']);

        $payload = json_encode($users);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
