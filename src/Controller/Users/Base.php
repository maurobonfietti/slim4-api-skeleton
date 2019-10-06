<?php declare(strict_types=1);

namespace App\Controller\Users;

use App\Service\UsersService;

abstract class Base
{
    protected $container;

    protected $usersService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getUsersService(): UsersService
    {
        return $this->container->get('users_service');
    }
}
