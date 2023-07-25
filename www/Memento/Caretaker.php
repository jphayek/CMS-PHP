<?php

namespace App\Memento;
use App\Memento\Memento;

class Caretaker
{
    private array $mementos = [];

    public function addMemento(Origin $origin)
{
    $this->mementos[] = $origin->createMemento();
}


    public function getMemento(int $index): ?Memento
    {
        return $this->mementos[$index] ?? null;
    }
}
