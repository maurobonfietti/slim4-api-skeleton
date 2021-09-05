<?php

declare(strict_types=1);

namespace App\Helper;

use Psr\Http\Message\ResponseInterface as Response;
use App\Helper\StatusCodeInterface;

final class JsonResponse
{
    public static function withJson(
        Response $response,
        string $data,
        int $status = StatusCodeInterface::STATUS_OK
    ): Response {
        $response->getBody()->write($data);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
