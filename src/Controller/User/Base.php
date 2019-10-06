<?php declare(strict_types=1);

namespace App\Controller\User;

use App\Service\UserService;

abstract class Base
{
    protected $container;

    protected $userService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getUserService(): UserService
    {
        return $this->container->get('user_service');
    }
}
