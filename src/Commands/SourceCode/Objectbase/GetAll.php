<?php declare(strict_types=1);

namespace App\Controller\Objectbase;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $objectbases = $this->getObjectbaseService()->getAllObjectbase();

        return $response->withJson($objectbases, 200);
    }
}
