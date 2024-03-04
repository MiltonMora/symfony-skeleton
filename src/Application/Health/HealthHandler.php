<?php

namespace App\Application\Health;

use App\Application\Health\Command\HealthCommand;
use App\Domain\Health\Model\Health;
use App\Domain\Health\Ports\HealthInterface;

class HealthHandler
{
    public function __construct(private readonly HealthInterface $healthInterface)
    {}

    public function handle(HealthCommand $command): string
    {
        $health = new Health(null, $command->getName());
        $this->healthInterface->save($health);
        return 'Healthy';
    }

}
