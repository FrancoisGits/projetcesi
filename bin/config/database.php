<?php

//fetching config file
$content = utf8_encode(file_get_contents(__DIR__ . '\config.json', FALSE, NULL));
$dbConfig = json_decode($content, true, 512, JSON_THROW_ON_ERROR)['database'];

//defining constants
define('DB_HOST', $dbConfig['host']);
define('DB_PORT', $dbConfig['port']);
define('DB_USER', $dbConfig['username']);
define('DB_PASS', $dbConfig['password']);
define('DB_DSN', 'mysql:dbname=connectlife' . ';host=' . DB_HOST . ';port=' . DB_PORT);

try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS);
} catch (\PDOException $e) {
    echo '¯\_(シ)_/¯: ' . $e->getMessage() . "\r\n";
}