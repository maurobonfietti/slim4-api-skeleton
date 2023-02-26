<?php

declare(strict_types=1);

namespace App;

use Slim\Psr7\Response as ResponseBase;

final class CustomResponse extends ResponseBase
{
    public function withJson(
        $data,
        int $status = 200,
        int $encodingOptions = 0
    ): self {
        $json = json_encode($data, $encodingOptions);

        if ($json === false) {
            throw new \RuntimeException(
                json_last_error_msg(),
                json_last_error()
            );
        }

        $this->getBody()->write($json);

        $responseWithJson = $this->withHeader(
            'Content-Type',
            'application/json;charset=utf-8'
        );

        if (isset($status)) {
            return $responseWithJson->withStatus($status);
        }

        return $responseWithJson;
    }
}
