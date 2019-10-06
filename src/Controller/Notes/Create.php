<?php declare(strict_types=1);

namespace App\Controller\Notes;

class Create extends Base
{
    public function __invoke($request, $response)
    {
        $input = $request->getParsedBody();
        $notes = $this->getNotesService()->createNotes($input);

        $payload = json_encode($notes);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
