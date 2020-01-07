<?php

namespace App\Service;

use App\Repository\TodoRepository;

class TodoManager
{
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function checkAll()
    {
        $this->todoRepository->checkAll();
    }

    public function uncheckAll()
    {
        $this->todoRepository->uncheckAll();
    }
}