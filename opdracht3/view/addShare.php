<?php
include '../includes/class-autoload.inc.php';
include 'navbar.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $shareContr = new SharesController();
        $shareContr->addShare($_SESSION['user_id'], $_POST['title'], $_POST['body'], $_POST['link']);
        header('Location: index.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Share</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Add a New Share</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="addShare.php">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link (optional)</label>
            <input type="url" class="form-control" id="link" name="link">
        </div>
        <button type="submit" class="btn btn-primary">Share</button>
    </form>
</div>
</body>
</html>
