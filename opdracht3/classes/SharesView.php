<?php

declare(strict_types=1);

class SharesView extends Share
{
    public function showAllShares(): void
    {
        $shares = $this->getAllShares();
        foreach ($shares as $share) {
            echo '<div class="card mt-3">';
            echo '<div class="card-header">';
            echo '<h5>' . htmlspecialchars($share['title']) . '</h5>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<p>' . htmlspecialchars($share['body']) . '</p>';
            echo '<a href="' . htmlspecialchars($share['link']) . '" target="_blank">' . htmlspecialchars($share['link']) . '</a>';
            echo '</div>';
            echo '<div class="card-footer text-muted">';
            echo 'Posted by ' . htmlspecialchars($share['name']) . ' on ' . $share['create_date'];
            echo '</div>';
            echo '</div>';
        }
    }
}

?>
