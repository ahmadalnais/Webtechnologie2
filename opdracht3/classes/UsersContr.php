<?php

declare(strict_types=1);

class UsersContr extends Users
{
    /**
     * @throws Exception
     */
    public function createUser(string $name, string $email, string $password): void
    {
        if ($name === '' || $email === '' || $password === '') {
            throw new Exception('All fields must be filled');
        }

        if ($this->getUser($email)) {
            throw new Exception('Email already exists');
        }

        $this->setUser($name, $email, $password);
    }

    /**
     * @throws Exception
     */
    public function loginUser(string $email, string $password): void
    {
        $user = $this->getUser($email);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
        } else {
            throw new Exception('Wrong password of email');
        }
    }
}

