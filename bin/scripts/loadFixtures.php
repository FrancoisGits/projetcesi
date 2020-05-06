<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../config/database.php';

// todo : check if works
function connect($withDbName){
    $dsn = !$withDbName ? 'mysql:host=' . DB_HOST . ';port=' . DB_PORT : DB_DSN;
    try {
        $db = new PDO($dsn, DB_USER, DB_PASS);
    } catch (\PDOException $e) {
        echo '¯\_(シ)_/¯: ' . $e->getMessage() . "\r\n";
    }
    return $db;
}

function load(){
    $withDbName = true;
    $db = connect($withDbName);

    echo "Loading fixtures: \r\n";

    try {
        $stmt = utf8_encode(file_get_contents(__DIR__ . '\connectlife_fixtures.sql', FALSE, NULL));
        echo "SQL file fetched ! \r\n";
        echo "loading data... \r\n";
        $db->exec($stmt);
        echo "... complete ! \r\n";
    } catch (Exception $e) {
        echo '¯\_(シ)_/¯: ' . $e->getMessage() . "\r\n";
    }
}

load();