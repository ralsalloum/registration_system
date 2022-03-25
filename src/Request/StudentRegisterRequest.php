<?php

namespace App\Request;

class StudentRegisterRequest
{
    private string $email;

    private $roles = [];

    private string $password;

    private string $fullName;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
