<?php

declare(strict_types=1);

class SharesController extends Share
{
    /**
     * @throws Exception
     */
    public function addShare($userId, $title, $body, $link): void
    {
        if (empty($title) || empty($body)) {
            throw new Exception('Titel en inhoud zijn verplicht.');
        }
        $this->createShare($userId, $title, $body, $link);
    }

    /**
     * @throws Exception
     */
    public function editShare($id, $title, $body, $link): void
    {
        if (empty($title) || empty($body)) {
            throw new Exception('Titel en inhoud zijn verplicht.');
        }
        $this->updateShare($id, $title, $body, $link);
    }

    public function removeShare($id): void
    {
        $this->deleteShare($id);
    }
}

