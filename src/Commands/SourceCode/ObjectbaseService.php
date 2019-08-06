<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ObjectbaseException;
use App\Repository\ObjectbaseRepository;

class ObjectbaseService extends BaseService
{
    protected $objectbaseRepository;

    public function __construct(ObjectbaseRepository $objectbaseRepository)
    {
        $this->objectbaseRepository = $objectbaseRepository;
    }

    protected function checkAndGetObjectbase(int $objectbaseId)
    {
        return $this->objectbaseRepository->checkAndGetObjectbase($objectbaseId);
    }

    public function getAllObjectbase(): array
    {
        return $this->objectbaseRepository->getAllObjectbase();
    }

    public function getObjectbase(int $objectbaseId)
    {
        return $this->checkAndGetObjectbase($objectbaseId);
    }

    public function createObjectbase($input)
    {
        $objectbase = json_decode(json_encode($input), false);

        return $this->objectbaseRepository->createObjectbase($objectbase);
    }

    public function updateObjectbase(array $input, int $objectbaseId)
    {
        $objectbase = $this->checkAndGetObjectbase($objectbaseId);
        $data = json_decode(json_encode($input), false);

        return $this->objectbaseRepository->updateObjectbase($objectbase, $data);
    }

    public function deleteObjectbase(int $objectbaseId): string
    {
        $this->checkAndGetObjectbase($objectbaseId);

        return $this->objectbaseRepository->deleteObjectbase($objectbaseId);
    }
}
