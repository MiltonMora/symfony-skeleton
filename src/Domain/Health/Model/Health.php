<?php

namespace App\Domain\Health\Model;

class Health
{

    private ?int $id;
    private string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

}
