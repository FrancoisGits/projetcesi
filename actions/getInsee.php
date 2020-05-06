<?php

require_once '../bin/config/database.php';

$cp = $_GET["codePostal"] ?: die('¯\_(シ)_/¯ => codePostal needed, null given');

try {
    $stmt = 'SELECT id, cp, ville, complement FROM insee WHERE cp=:needle';
    $prep = $db->prepare($stmt);
    $prep->execute([':needle' => $cp]);
    $result = $prep->fetchAll();

    echo json_encode($result, JSON_THROW_ON_ERROR, 512);
} catch (Exception $e) {
    die('¯\_(シ)_/¯ =>' . $e->getMessage());
}
