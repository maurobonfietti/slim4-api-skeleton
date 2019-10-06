<?php declare(strict_types=1);

namespace App\Controller\Tasks;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $taskss = $this->getTasksService()->getAllTasks();

        $payload = json_encode($taskss);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
