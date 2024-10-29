<?php

declare(strict_types=1);

class Dbh
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $pwd = 'root';
    private string $dbName = 'shareboard';

    protected function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }
}
