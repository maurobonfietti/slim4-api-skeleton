<?php declare(strict_types=1);

namespace App\Controller\User;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $user = $this->getUserService()->updateUser($input, (int) $args['id']);

        $payload = json_encode($user);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
