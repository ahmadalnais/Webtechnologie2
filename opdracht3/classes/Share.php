<?php

declare(strict_types=1);

class Share extends Dbh
{
    public function getAllShares(): false|array
    {
        $sql = "SELECT shares.*, users.name FROM shares JOIN users ON shares.user_id = users.id ORDER BY create_date DESC";
        return $this->connect()->query($sql)->fetchAll();
    }

    public function getShare($id)
    {
        $sql = "SELECT * FROM shares WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createShare($userId, $title, $body, $link): void
    {
        $sql = "INSERT INTO shares (user_id, title, body, link) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId, $title, $body, $link]);
    }

    public function updateShare($id, $title, $body, $link): void
    {
        $sql = "UPDATE shares SET title = ?, body = ?, link = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$title, $body, $link, $id]);
    }

    public function deleteShare($id): void
    {
        $sql = "DELETE FROM shares WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}