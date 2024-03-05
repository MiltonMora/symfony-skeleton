<?php

namespace App\Controller\Api\User;

use App\Application\User\Command\User;
use App\Controller\AbstractGeneralController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/user')]
class UserController extends AbstractGeneralController
{
    #[Route('/verify', name: 'app_health')]
    public function verify(): Response
    {
        $data = $this->commandBus->handle(new User('user', 'user', 'user@gmail.com'));
        return $this->render('health/index.html.twig', [
            'controller_name' => 'HealthController',
            'data' => $data
        ]);
    }
}
