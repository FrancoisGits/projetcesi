<?php

require_once '../bin/config/database.php';

/**
 * @param PDO $db
 * @return string
 */
function getGUID(PDO $db){
    $charId = md5(uniqid(mt_rand(), true));
    $hyphen = chr(45);// "-"
    $guid = substr($charId, 0, 8).$hyphen
        .substr($charId, 8, 4).$hyphen
        .substr($charId,12, 4).$hyphen
        .substr($charId,16, 4).$hyphen
        .substr($charId,20,12);

    try{
        $stmt = 'SELECT guid FROM fixtures WHERE guid=:needle';
        $prep = $db->prepare($stmt);
        $prep->execute([':needle' => $guid]);
        $result = $prep->fetchAll();
        if (count($result) > 0){
            $guid = getGUID();
        }
    } catch (PDOException $e) {
        die('¯\_(シ)_/¯: ' . $e->getMessage() . "\r\n");
    }

    return $guid;
}
