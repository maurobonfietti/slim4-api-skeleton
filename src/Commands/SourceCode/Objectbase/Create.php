<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use Slim\Http\Request;
use Slim\Http\Response;

class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $objectbase = $this->getObjectbaseService()->createObjectbase($input);

        return $response->withJson($objectbase, 201);
    }
}
