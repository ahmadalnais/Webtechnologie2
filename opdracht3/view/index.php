<?php
// index.php
include '../includes/class-autoload.inc.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBoard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<!-- Content -->
<div class="container mt-4">
    <h1>Welcome to ShareBoard</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="addShare.php" class="btn btn-primary mb-3">Add Share</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-secondary mb-3">Login to Share</a>
    <?php endif; ?>

    <?php
    $sharesView = new SharesView();
    $shares = $sharesView->getAllShares();

    foreach ($shares as $share) {
        echo '<div class="card mt-3">';
        echo '<div class="card-header"><h5>' . htmlspecialchars($share['title']) . '</h5></div>';
        echo '<div class="card-body">';
        echo '<p>' . htmlspecialchars($share['body']) . '</p>';
        echo '<a href="' . htmlspecialchars($share['link']) . '" target="_blank">' . htmlspecialchars($share['link']) . '</a>';
        echo '</div>';
        echo '<div class="card-footer text-muted">';
        echo 'Posted by ' . htmlspecialchars($share['name']) . ' on ' . $share['create_date'];

        // Alleen delete-knop weergeven als ingelogde gebruiker eigenaar is van de share
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $share['user_id']) {
            echo ' <a href="deleteShare.php?id=' . $share['id'] . '" class="btn btn-danger btn-sm float-end" onclick="return confirm(\'Are you sure you want to delete this share?\');">Delete</a>';
        }

        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
