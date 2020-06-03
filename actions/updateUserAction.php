<?php
session_start();
require_once '../bin/config/database.php';
require './validator.php';

$invalidEmail = false;

/**
 * Creates an array representing a user, validates and sanitizes user input
 */
if (!empty($_POST) && isset($_SESSION['user'])) {
    $isSociete = $_SESSION['user']['isSociete'] === '1';
    $user['guid'] = $_SESSION['user']['guid'];
    $user['civilite'] = $_POST['civilite'];
    $user['nom'] = sanitizeString($_POST['nom'], MB_CASE_UPPER);
    $user['prenom'] = sanitizeString($_POST['prenom'], MB_CASE_TITLE);
    $user['societe'] = $_POST['societe'] ? sanitizeString($_POST['societe'], MB_CASE_UPPER) : null;
    $user['poste'] = $_POST['poste'] ? sanitizeString($_POST['poste'], MB_CASE_TITLE) : null;
    $user['adresse1'] = sanitizeString($_POST['adresse1'], MB_CASE_TITLE);
    $user['adresse2'] = mb_convert_case(trim(filter_var($_POST['adresse2'], FILTER_SANITIZE_STRING)), MB_CASE_TITLE, 'UTF-8') ?: null;
    $user['codeInsee'] = $_POST['codeInsee'];
    $user['telPro'] = sanitizePhoneNumber($_POST['telPro']);
    $user['telPerso'] = sanitizePhoneNumber($_POST['telPerso']);
    if ($_SESSION['user']['mail'] === sanitizeString($_POST['email'], MB_CASE_LOWER)){
        $user['email'] = sanitizeString($_POST['email'], MB_CASE_LOWER);
    } else {
        $fixtureEmail = $_SESSION['user']['mail'];
        $invalidEmail = true;
    }
    $user['exported'] = 0;
    $_SESSION['user'] = $user;
    $_SESSION['user']['mail'] = $fixtureEmail;
    $_SESSION['user']['codePostal'] = $_POST['codePostal'];
    $_SESSION['user']['isSociete'] = $isSociete === true ? '1' : '0';

    if ($invalidEmail === true || validateUser() !== true){
        header('Location:' . APP_ROOT . '/invalidEmail');
        exit();
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
try {
    $prep = $db->prepare($stmt);
    $prep->execute($params);
} catch (PDOException $e){
    if (PRODUCTION === false){
        echo $e->getMessage();
    }
    addToLog($e->getMessage());
}


$userGuid = $user['guid'];
$userName = $user['nom'] . ' ' . $user['prenom'];
addToLog("Added : $userGuid $userName");

$_SESSION['submittedForm'] = true;
header('Location:' . APP_ROOT);
exit();