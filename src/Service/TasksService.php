<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\TasksException;
use App\Repository\TasksRepository;

class TasksService extends BaseService
{
    protected $tasksRepository;

    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    protected function checkAndGetTasks(int $tasksId)
    {
        return $this->tasksRepository->checkAndGetTasks($tasksId);
    }

    public function getAllTasks(): array
    {
        return $this->tasksRepository->getAllTasks();
    }

    public function getTasks(int $tasksId)
    {
        return $this->checkAndGetTasks($tasksId);
    }

    public function createTasks($input)
    {
        $tasks = json_decode(json_encode($input), false);

        return $this->tasksRepository->createTasks($tasks);
    }

    public function updateTasks(array $input, int $tasksId)
    {
        $tasks = $this->checkAndGetTasks($tasksId);
        $data = json_decode(json_encode($input), false);

        return $this->tasksRepository->updateTasks($tasks, $data);
    }

    public function deleteTasks(int $tasksId)
    {
        $this->checkAndGetTasks($tasksId);
        $this->tasksRepository->deleteTasks($tasksId);
    }
}
