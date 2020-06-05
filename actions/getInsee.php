<?php
require_once '../bin/config/config.php';
require_once '../bin/config/database.php';

$cp = $_GET["codePostal"] ?: die('Error : codePostal needed, null given');

try {
    $stmt = 'SELECT id, cp, ville, complement FROM insee WHERE cp=:needle';
    $prep = $db->prepare($stmt);
    $prep->execute([':needle' => $cp]);
    $result = $prep->fetchAll();

    echo json_encode($result);
} catch (Exception $e) {
    if (PRODUCTION === false){
        die('Error :' . $e->getMessage());
    }
    addToLog($e->getMessage());
}
