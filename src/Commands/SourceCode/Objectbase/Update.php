<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use Slim\Http\Request;
use Slim\Http\Response;

class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $objectbase = $this->getObjectbaseService()->updateObjectbase($input, (int) $args['id']);

        return $response->withJson($objectbase, 200);
    }
}
