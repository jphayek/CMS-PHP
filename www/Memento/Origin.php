<?php

// App/Memento/Origin.php
namespace App\Memento;

use App\Models\Pages;

class Origin
{
    private Pages $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function createMemento(): Memento
    {
        return new Memento($this->pages->getStatus());
    }


    public function restoreMemento(Memento $memento): void
    {
        $this->pages->setStatus($memento->getState());
    }
}
