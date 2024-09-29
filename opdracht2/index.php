<?php

declare(strict_types = 1);

$root = dirname(__DIR__). '\opdracht2' . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require 'App.php';

$files = getFiles(FILES_PATH);

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    if (in_array($file, $files)) {
        $transactions = getTransactions(FILES_PATH . $file);
        $totals = calculateTotals($transactions);
        require VIEWS_PATH . 'transactions.php';
    } else {
        echo "Bestand niet gevonden.";
    }
} else {
    echo '<h1>Beschikbare bestanden:</h1>';
    echo '<ul>';
    foreach ($files as $file) {
        echo '<li><a href="?file=' . urlencode($file) . '">' . htmlspecialchars($file) . '</a></li>';
    }
    echo '</ul>';
}
