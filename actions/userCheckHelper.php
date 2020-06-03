<?php

/**
 * @param string $guid
 * @param PDO $db
 * @return array|string
 */
function checkUser(string $guid, PDO $db) {

    $stmt = 'SELECT * FROM fixtures WHERE guid=:guid';
    $prep = $db->prepare($stmt);
    $prep->execute(['guid' => $guid]);
    $user = $prep->fetch();

    if (empty($user)){
        return 'none';
    }

    $stmt = 'SELECT * FROM clients WHERE guid=:guid';
    $prep = $db->prepare($stmt);
    $prep->execute(['guid' => $guid]);
    $existingCustomer = $prep->fetch();

    if (!empty($existingCustomer)){
        return 'existing';
    }

    return $user;
}