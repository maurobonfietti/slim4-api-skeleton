<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\TeamException;
use App\Repository\TeamRepository;

class TeamService extends BaseService
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    protected function checkAndGetTeam(int $teamId)
    {
        return $this->teamRepository->checkAndGetTeam($teamId);
    }

    public function getAllTeam(): array
    {
        return $this->teamRepository->getAllTeam();
    }

    public function getTeam(int $teamId)
    {
        return $this->checkAndGetTeam($teamId);
    }

    public function createTeam($input)
    {
        $team = json_decode(json_encode($input), false);

        return $this->teamRepository->createTeam($team);
    }

    public function updateTeam(array $input, int $teamId)
    {
        $team = $this->checkAndGetTeam($teamId);
        $data = json_decode(json_encode($input), false);

        return $this->teamRepository->updateTeam($team, $data);
    }

    public function deleteTeam(int $teamId): string
    {
        $this->checkAndGetTeam($teamId);

        return $this->teamRepository->deleteTeam($teamId);
    }
}
