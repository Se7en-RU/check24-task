<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Support\PaginationTrait;
use Throwable;

class UserService
{
    use PaginationTrait;

    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): bool
    {
        try {
            $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

            $user = (new User())
                ->setLogin($data['login'])
                ->setPassword($passwordHash);

            $this->userRepository->create($user);
        } catch (Throwable) {
            return false;
        }

        return true;
    }

    public function login(string $login, string $password): bool
    {
        $user = $this->getByLogin($login);

        if (!empty($user) && password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = [
                'id'    => $user->getId(),
                'login' => $user->getLogin(),
            ];

            return true;
        }

        return false;
    }

    public function logout(): bool
    {
        if (session_destroy()) {
            return true;
        }

        return false;
    }


    public function getById(int $id): ?User
    {
        $user = $this->userRepository->getById($id);

        return $user;
    }

    public function getByLogin(string $login): ?User
    {
        $user = $this->userRepository->getByLogin($login);

        return $user;
    }
}