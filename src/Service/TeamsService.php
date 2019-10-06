<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\TeamsException;
use App\Repository\TeamsRepository;

class TeamsService extends BaseService
{
    protected $teamsRepository;

    public function __construct(TeamsRepository $teamsRepository)
    {
        $this->teamsRepository = $teamsRepository;
    }

    protected function checkAndGetTeams(int $teamsId)
    {
        return $this->teamsRepository->checkAndGetTeams($teamsId);
    }

    public function getAllTeams(): array
    {
        return $this->teamsRepository->getAllTeams();
    }

    public function getTeams(int $teamsId)
    {
        return $this->checkAndGetTeams($teamsId);
    }

    public function createTeams($input)
    {
        $teams = json_decode(json_encode($input), false);

        return $this->teamsRepository->createTeams($teams);
    }

    public function updateTeams(array $input, int $teamsId)
    {
        $teams = $this->checkAndGetTeams($teamsId);
        $data = json_decode(json_encode($input), false);

        return $this->teamsRepository->updateTeams($teams, $data);
    }

    public function deleteTeams(int $teamsId)
    {
        $this->checkAndGetTeams($teamsId);
        $this->teamsRepository->deleteTeams($teamsId);
    }
}
