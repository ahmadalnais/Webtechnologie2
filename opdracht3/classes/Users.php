<?php

declare(strict_types=1);

class Users extends Dbh
{
    protected function getUser(string $email): false|array
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        // Use fetch() for 1 row, and fetchAll() for all rows
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function setUser(string $name, string $email, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $hashedPassword]);
    }
}
