<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use App\Service\ObjectbaseService;
use Slim\Container;

abstract class Base
{
    protected $container;

    protected $objectbaseService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getObjectbaseService(): ObjectbaseService
    {
        return $this->container->get('objectbase_service');
    }
}
