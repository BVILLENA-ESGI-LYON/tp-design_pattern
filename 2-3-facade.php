<?php

declare(strict_types=1);


class UserFacade
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function update(User $user): void
    {
        $this->userRepository->update($user);
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }
}

// Exemple façade pour gérer les utilisateurs
$userRepository = new UserRepository();
$userFacade = new UserFacade($userRepository);

// Utilisation façade pour gérer les utilisateurs
$user = $userFacade->findById(1);
var_dump($user);

$users = $userFacade->findAll();
var_dump($users);

$newUser = new User("Dwayne Johnson", "DJohnson@jumanji.com");
$userFacade->save($newUser);

$newUser->setName("Max Verstapen");
$userFacade->update($newUser);

$userFacade->delete($newUser);
