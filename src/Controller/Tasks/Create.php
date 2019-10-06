<?php declare(strict_types=1);

namespace App\Controller\Tasks;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $tasks = $this->getTasksService()->createTasks($input);

        $payload = json_encode($tasks);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
