<?php declare(strict_types=1);

namespace App\Controller\Teams;

use App\Service\TeamsService;

abstract class Base
{
    protected $container;

    protected $teamsService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getTeamsService(): TeamsService
    {
        return $this->container->get('teams_service');
    }
}
