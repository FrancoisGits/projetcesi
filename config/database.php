<?php

/**
 * Credentials BDD
 */
$dsn = 'mysql:dbname=test;host=127.0.0.1;port=3306';
$user = 'root';
$password = '';

try {
    $db = new PDO($dsn, $user, $password);
} catch (\PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}