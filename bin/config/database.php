<?php
require 'config.php';
$dbConfig = $content['database'];

//defining constants
define('DB_HOST', $dbConfig['host']);
define('DB_PORT', $dbConfig['port']);
define('DB_USER', $dbConfig['username']);
define('DB_PASS', $dbConfig['password']);
define('DB_DSN', 'mysql:dbname=connectlife' . ';charset=UTF8' . ';host=' . DB_HOST . ';port=' . DB_PORT);

try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS,);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (\PDOException $e) {
    die('¯\_(シ)_/¯: ' . $e->getMessage() . "\r\n");
}
