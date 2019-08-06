<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $objectbase = $this->getObjectbaseService()->getObjectbase((int) $args['id']);

        return $response->withJson($objectbase, 200);
    }
}
