<?php

declare(strict_types=1);

namespace App\Helper;

use Psr\Http\Message\ResponseInterface as Response;

final class JsonResponse
{
    public static function withJson(
        Response $response,
        string $data,
        int $status = 200
    ): Response {
        $response->getBody()->write($data);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
