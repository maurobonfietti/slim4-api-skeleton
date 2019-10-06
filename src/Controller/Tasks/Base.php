<?php declare(strict_types=1);

namespace App\Controller\Tasks;

use App\Service\TasksService;

abstract class Base
{
    protected $container;

    protected $tasksService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getTasksService(): TasksService
    {
        return $this->container->get('tasks_service');
    }
}
