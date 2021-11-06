<?php

declare(strict_types=1);

namespace App;

use Slim\Psr7\Response as ResponseBase;

class CustomResponse extends ResponseBase
{
    /**
     * Json.
     *
     * Note: This method is not part of the PSR-7 standard.
     *
     * This method prepares the response object to return an HTTP Json
     * response to the client.
     *
     * @param  any  $data   The data
     * @param  int    $status The HTTP status code.
     * @param  int    $encodingOptions Json encoding options
     * @throws \RuntimeException
     * @return self
     */
    public function withJson($data, int $status = 200, int $encodingOptions = 0): self
    {
        $json = json_encode($data, $encodingOptions);
        
        // Ensure that the json encoding passed successfully
        if ($json === false) {
            throw new \RuntimeException(json_last_error_msg(), json_last_error());
        }

        $this->getBody()->write($json);

        $responseWithJson = $this->withHeader('Content-Type', 'application/json;charset=utf-8');
        if (isset($status)) {
            return $responseWithJson->withStatus($status);
        }
        return $responseWithJson;
    }
}