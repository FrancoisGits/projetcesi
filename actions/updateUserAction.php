<?php

require_once '../bin/config/database.php';
require './sanitizer.php';
require './GUIDHelper.php';

/**
 * Creates an array representing a user, validates and sanitizes user input
 */
if (!empty($_POST)) {
    try {
        $user['guid'] = /*$_SESSION['GUID'] ?: */getGUID($db);
        var_dump($_POST['civilite']);
        var_dump(preg_match('/(M.|Mme)/', $_POST['civilite']));
        if (!empty($_POST['civilite']) && preg_match('/(M.|Mme)/', $_POST['civilite'])) {
             $user['civilite'] = $_POST['civilite'];
        } else {
            throw new Exception('¯\_(シ)_/¯ => not valid or null civilite given');
        }
        $user['nom'] = sanitizeString($_POST['nom'], MB_CASE_UPPER);
        $user['prenom'] = sanitizeString($_POST['prenom'], MB_CASE_TITLE);
        $user['societe'] = $_POST['societe'] ? sanitizeString($_POST['societe'], MB_CASE_UPPER) : null;
        $user['poste'] = $_POST['poste'] ? sanitizeString($_POST['poste'], MB_CASE_TITLE) : null;
        $user['adresse1'] = sanitizeString($_POST['adresse1'], MB_CASE_TITLE);
        $user['adresse2'] = mb_convert_case(trim(filter_var($_POST['adresse2'], FILTER_SANITIZE_STRING)), MB_CASE_TITLE, 'UTF-8') ?: null;

        if (!empty($_POST['codeInsee']) && preg_match('/[0-9]{3,5}/', $_POST['codeInsee'])) {
                $user['codeInsee'] = $_POST['codeInsee'];
        } else {
            throw new Exception('¯\_(シ)_/¯ => not valid or null codeInsee given');
        }

        $user['telPro'] = sanitizePhoneNumber($_POST['telPro']);
        $user['telPerso'] = sanitizePhoneNumber($_POST['telPerso']);
        $user['email'] = sanitizeEmail($_POST['email']);
        $user['exported'] = 0;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

$stmt = 'INSERT INTO connectlife.clients (
                                 civilite, 
                                 nom, 
                                 prenom, 
                                 adresse1, 
                                 adresse2, 
                                 telephone1, 
                                 telephone2, 
                                 email, 
                                 societe, 
                                 poste,
                                 guid,
                                 exported,
                                 inseeId) 
                                 VALUES (
                                 :civilite, 
                                 :nom, 
                                 :prenom, 
                                 :adresse1, 
                                 :adresse2, 
                                 :telephone1, 
                                 :telephone2, 
                                 :email, 
                                 :societe, 
                                 :poste,
                                 :guid,
                                 :exported,
                                 :inseeId);';

$params = [
    'civilite' => $user['civilite'],
    'nom' => $user['nom'],
    'prenom' => $user['prenom'],
    'adresse1' => $user['adresse1'],
    'adresse2' => $user['adresse2'],
    'telephone1' => $user['telPerso'],
    'telephone2' => $user['telPro'],
    'email' => $user['email'],
    'societe' => $user['societe'],
    'poste' => $user['poste'],
    'guid' => $user['guid'],
    'exported' => $user['exported'],
    'inseeId' => $user['codeInsee']
];
$prep = $db->prepare($stmt);
$prep->execute($params);

