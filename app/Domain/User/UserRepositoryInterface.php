<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function create(User $user): void;

    public function getById(int $id): ?User;

    public function getByLogin(string $login): ?User;
}