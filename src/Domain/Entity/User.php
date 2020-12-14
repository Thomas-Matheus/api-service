<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User.
 */
class User implements UserInterface
{
    private int $id;

    private string $username;

    private string $password;

    private bool $isActive;

    /**
     * User constructor.
     * @param $username
     */
    public function __construct($username)
    {
        $this->isActive = true;
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }
}
