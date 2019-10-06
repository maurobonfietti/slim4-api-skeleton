<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\PlayerException;
use App\Repository\PlayerRepository;

class PlayerService extends BaseService
{
    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    protected function checkAndGetPlayer(int $playerId)
    {
        return $this->playerRepository->checkAndGetPlayer($playerId);
    }

    public function getAllPlayer(): array
    {
        return $this->playerRepository->getAllPlayer();
    }

    public function getPlayer(int $playerId)
    {
        return $this->checkAndGetPlayer($playerId);
    }

    public function createPlayer($input)
    {
        $player = json_decode(json_encode($input), false);

        return $this->playerRepository->createPlayer($player);
    }

    public function updatePlayer(array $input, int $playerId)
    {
        $player = $this->checkAndGetPlayer($playerId);
        $data = json_decode(json_encode($input), false);

        return $this->playerRepository->updatePlayer($player, $data);
    }

    public function deletePlayer(int $playerId)
    {
        $this->checkAndGetPlayer($playerId);
        $this->playerRepository->deletePlayer($playerId);
    }
}
