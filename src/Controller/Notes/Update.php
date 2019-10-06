<?php declare(strict_types=1);

namespace App\Controller\Notes;

class Update extends Base
{
    public function __invoke($request, $response, array $args)
    {
        $input = $request->getParsedBody();
        $notes = $this->getNotesService()->updateNotes($input, (int) $args['id']);

        $payload = json_encode($notes);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
