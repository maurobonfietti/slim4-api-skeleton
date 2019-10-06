<?php declare(strict_types=1);

namespace App\Controller\Tasks;

class GetOne extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $tasks = $this->getTasksService()->getTasks((int) $args['id']);

        $payload = json_encode($tasks);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
