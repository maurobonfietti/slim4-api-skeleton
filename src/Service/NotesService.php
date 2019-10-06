<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\NotesException;
use App\Repository\NotesRepository;

class NotesService extends BaseService
{
    protected $notesRepository;

    public function __construct(NotesRepository $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    protected function checkAndGetNotes(int $notesId)
    {
        return $this->notesRepository->checkAndGetNotes($notesId);
    }

    public function getAllNotes(): array
    {
        return $this->notesRepository->getAllNotes();
    }

    public function getNotes(int $notesId)
    {
        return $this->checkAndGetNotes($notesId);
    }

    public function createNotes($input)
    {
        $notes = json_decode(json_encode($input), false);

        return $this->notesRepository->createNotes($notes);
    }

    public function updateNotes(array $input, int $notesId)
    {
        $notes = $this->checkAndGetNotes($notesId);
        $data = json_decode(json_encode($input), false);

        return $this->notesRepository->updateNotes($notes, $data);
    }

    public function deleteNotes(int $notesId)
    {
        $this->checkAndGetNotes($notesId);
        $this->notesRepository->deleteNotes($notesId);
    }
}
