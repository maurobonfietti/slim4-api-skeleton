<?php declare(strict_types=1);

namespace App\Controller\Notes;

use App\Service\NotesService;

abstract class Base
{
    protected $container;

    protected $notesService;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getNotesService(): NotesService
    {
        return $this->container->get('notes_service');
    }
}
