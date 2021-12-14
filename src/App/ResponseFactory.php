<?php

declare(strict_types=1);

use App\CustomResponse;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;

final class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(
        int $code = StatusCodeInterface::STATUS_OK,
        string $reasonPhrase = ''
    ): Response {
        return (new CustomResponse())->withStatus($code, $reasonPhrase);
    }
}
