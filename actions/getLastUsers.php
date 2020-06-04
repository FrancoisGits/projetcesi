<?php
session_start();
require_once '../bin/config/config.php';
require_once '../bin/config/database.php';
require_once '../bin/config/logger.php';

try {
    $stmt = 'SELECT COUNT(cl.id) AS toExport
        FROM connectlife.clients cl 
        WHERE cl.exported = 0';

    $query = $db->query($stmt);
    $result = $query->fetch();

    echo json_encode($result, JSON_THROW_ON_ERROR, 512);

} catch (Exception $e) {
    if (PRODUCTION === false) {
        echo $e->getMessage();
    }
    addToLog($e->getMessage());
}