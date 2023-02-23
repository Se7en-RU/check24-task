<?php

declare(strict_types=1);


namespace App\Infrastructure\Repository;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Database\DatabaseInterface;

class UserDatabaseRepository implements UserRepositoryInterface
{
    public function __construct(private readonly DatabaseInterface $database)
    {
    }

    public function create(User $user): void
    {
        $this->database->query(
            'INSERT INTO users (login, password) VALUES (:login, :password)',
            [
                ':login' => $user->getLogin(),
                ':password' => $user->getPassword(),
            ]
        );
    }

    public function getById(int $id): ?User
    {
        $res = $this->database->query(
            'SELECT * FROM users WHERE id=:id',
            [':id' => $id],
            User::class
        );

        return !empty($res) ? $res[0] : null;
    }

    public function getByLogin(string $login): ?User
    {
        $res = $this->database->query(
            'SELECT * FROM users WHERE login=:login',
            [':login' => $login]
        );

        if (!empty($res)) {
            $res = $res[0];

            return (new User())
                ->setId($res->id)
                ->setLogin($res->login)
                ->setPassword($res->password)
                ->setCreatedAt($res->created_at)
                ->setUpdatedAt($res->updated_at);
        }

        return null;
    }
}