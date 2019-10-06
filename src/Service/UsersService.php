<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\UsersException;
use App\Repository\UsersRepository;

class UsersService extends BaseService
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    protected function checkAndGetUsers(int $usersId)
    {
        return $this->usersRepository->checkAndGetUsers($usersId);
    }

    public function getAllUsers(): array
    {
        return $this->usersRepository->getAllUsers();
    }

    public function getUsers(int $usersId)
    {
        return $this->checkAndGetUsers($usersId);
    }

    public function createUsers($input)
    {
        $users = json_decode(json_encode($input), false);

        return $this->usersRepository->createUsers($users);
    }

    public function updateUsers(array $input, int $usersId)
    {
        $users = $this->checkAndGetUsers($usersId);
        $data = json_decode(json_encode($input), false);

        return $this->usersRepository->updateUsers($users, $data);
    }

    public function deleteUsers(int $usersId)
    {
        $this->checkAndGetUsers($usersId);
        $this->usersRepository->deleteUsers($usersId);
    }
}
