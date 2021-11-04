<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Fig\Http\Message\StatusCodeInterface;
use App\CustomResponse;

class ResponseFactory implements ResponseFactoryInterface {
    public function createResponse(int $code = StatusCodeInterface::STATUS_OK, string $reasonPhrase = '') : Response {
        return (new CustomResponse())->withStatus($code, $reasonPhrase);
    }
}
