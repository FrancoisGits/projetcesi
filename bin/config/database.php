<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/logger.php';

try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS,);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (\PDOException $e) {
    addToLog($e->getMessage());
    die('Error : ' . $e->getMessage() . "\r\n");
}
