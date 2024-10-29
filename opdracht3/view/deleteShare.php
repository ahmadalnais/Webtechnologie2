<?php
include '../includes/class-autoload.inc.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $shareId = $_GET['id'];
    $shareContr = new SharesController();
    $shareContr->removeShare($shareId);
}

header('Location: index.php');
exit();
