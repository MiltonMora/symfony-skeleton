<?php

namespace App\Controller\health;

use App\Application\Health\Command\HealthCommand;
use App\Controller\AbstractGeneralController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/health')]
class HealthController extends AbstractGeneralController
{
    #[Route('/verify', name: 'app_health')]
    public function verify(): Response
    {
        $data = $this->commandBus->handle(new HealthCommand());
        return $this->render('health/index.html.twig', [
            'controller_name' => 'HealthController',
            'data' => $data
        ]);
    }
}
