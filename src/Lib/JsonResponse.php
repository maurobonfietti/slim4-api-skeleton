<?php

declare(strict_types=1);

namespace App\Lib;

final class JsonResponse
{
    public static function withJson($response, $data, $status = 200)
    {
        $response->getBody()->write($data);

        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}
