<?php declare(strict_types=1);

namespace App\Controller\Notes;

class GetAll extends Base
{
    public function __invoke($request, $response)
    {
        $notess = $this->getNotesService()->getAllNotes();

        $payload = json_encode($notess);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
