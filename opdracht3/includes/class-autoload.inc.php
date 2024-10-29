<?php
// includes/class-autoload.inc.php

spl_autoload_register(/**
 * @throws Exception
 */ static function ($className) {
    $path = __DIR__ . '/../classes/' . $className . '.php';
    if (file_exists($path)) {
        include_once $path;
    } else {
        throw new Exception("Class file for {$className} not found.");
    }
});