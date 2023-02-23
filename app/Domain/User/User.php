<?php

declare(strict_types=1);

namespace App\Domain\User;

class User
{
    private int $id;
    private string $login;
    private string $password;
    private string $createdAt;
    private string $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return User
     */
    public function setLogin(string $login): User
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return User
     */
    public function setCreatedAt(string $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return User
     */
    public function setUpdatedAt(string $updatedAt): User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}