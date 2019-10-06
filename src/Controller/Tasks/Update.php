<?php declare(strict_types=1);

namespace App\Controller\Tasks;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $tasks = $this->getTasksService()->updateTasks($input, (int) $args['id']);

        $payload = json_encode($tasks);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
