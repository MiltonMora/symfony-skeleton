<?php

namespace App\Application\User;

use App\Application\User\Command\User;
use App\Domain\User\Model\User as UserModel;
use App\Domain\User\Ports\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserHandler
{
    public function __construct(
        private readonly UserInterface $userInterface,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function handle(User $command): string
    {
        $user = new UserModel();
        $hashedPassword = $this->userPasswordHasher->hashPassword($user, $command->getPassword());
        $user->setName($command->getName());
        $user->setEmail($command->getEmail());
        $user->setPassword($hashedPassword);
        $user->setRoles(['USER_ROL']);
        $this->userInterface->save($user);
        return 'Healthy';
    }

}
