<?php declare(strict_types=1);

namespace App\Controller\Player;

use App\Service\PlayerService;

abstract class Base
{
    protected $container;

    protected $playerService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getPlayerService(): PlayerService
    {
        return $this->container->get('player_service');
    }
}
