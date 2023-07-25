<?php

namespace App\Memento;

class Memento
{
    private int $state;

    public function __construct(int $state)
    {
        $this->state = $state;
    }

    public function getState(): int
    {
        return $this->state;
    }
}
