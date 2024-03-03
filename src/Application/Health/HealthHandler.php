<?php

namespace App\Application\Health;

use App\Application\Health\Command\HealthCommand;

class HealthHandler
{
    public function handle(HealthCommand $command): string
    {
        return 'Healthy';
    }

}
