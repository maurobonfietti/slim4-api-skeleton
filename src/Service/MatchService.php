<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\MatchException;
use App\Repository\MatchRepository;

class MatchService extends BaseService
{
    protected $matchRepository;

    public function __construct(MatchRepository $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    protected function checkAndGetMatch(int $matchId)
    {
        return $this->matchRepository->checkAndGetMatch($matchId);
    }

    public function getAllMatch(): array
    {
        return $this->matchRepository->getAllMatch();
    }

    public function getMatch(int $matchId)
    {
        return $this->checkAndGetMatch($matchId);
    }

    public function createMatch($input)
    {
        $match = json_decode(json_encode($input), false);

        return $this->matchRepository->createMatch($match);
    }

    public function updateMatch(array $input, int $matchId)
    {
        $match = $this->checkAndGetMatch($matchId);
        $data = json_decode(json_encode($input), false);

        return $this->matchRepository->updateMatch($match, $data);
    }

    public function deleteMatch(int $matchId)
    {
        $this->checkAndGetMatch($matchId);
        $this->matchRepository->deleteMatch($matchId);
    }
}
