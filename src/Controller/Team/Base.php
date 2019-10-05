<?php declare(strict_types=1);

namespace App\Controller\Team;

use App\Service\TeamService;
//use Slim\Container;

abstract class Base
{
    protected $container;

    protected $teamService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getTeamService(): TeamService
    {
        return $this->container->get('team_service');
    }
}
