<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use Slim\Http\Request;
use Slim\Http\Response;

class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $objectbase = $this->getObjectbaseService()->deleteObjectbase((int) $args['id']);

        return $response->withJson($objectbase, 204);
    }
}
