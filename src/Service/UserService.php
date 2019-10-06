<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\UserException;
use App\Repository\UserRepository;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function checkAndGetUser(int $userId)
    {
        return $this->userRepository->checkAndGetUser($userId);
    }

    public function getAllUser(): array
    {
        return $this->userRepository->getAllUser();
    }

    public function getUser(int $userId)
    {
        return $this->checkAndGetUser($userId);
    }

    public function createUser($input)
    {
        $user = json_decode(json_encode($input), false);

        return $this->userRepository->createUser($user);
    }

    public function updateUser(array $input, int $userId)
    {
        $user = $this->checkAndGetUser($userId);
        $data = json_decode(json_encode($input), false);

        return $this->userRepository->updateUser($user, $data);
    }

    public function deleteUser(int $userId)
    {
        $this->checkAndGetUser($userId);
        $this->userRepository->deleteUser($userId);
    }
}
