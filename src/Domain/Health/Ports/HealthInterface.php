<?php

namespace App\Domain\Health\Ports;

use App\Domain\Health\Model\Health;

interface HealthInterface
{
    public function save(Health $health): void;
}
