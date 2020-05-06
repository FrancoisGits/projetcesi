<?php

require_once '../bin/config/database.php';
require './sanitizer.php';
require './GUIDHelper.php';

/**
 * Creates an array representing a user, validates and sanitizes user input
 */
if (!empty($_POST)) {
    try {
        $user['guid'] = $_SESSION['GUID'] ?: getGUID($db);
        $user['civilite'] = $_POST['civilite'] ?: 0;
        $user['nom'] = sanitizeString($_POST['nom'], MB_CASE_UPPER);
        $user['prenom'] = sanitizeString($_POST['prenom'], MB_CASE_TITLE);
        $user['societe'] = $_POST['societe'] ? sanitizeString($_POST['societe'], MB_CASE_UPPER) : null;
        $user['poste'] = $_POST['poste'] ? sanitizeString($_POST['poste'], MB_CASE_TITLE) : null;
        $user['adresse1'] = sanitizeString($_POST['adresse1'], MB_CASE_TITLE);
        $user['adresse2'] = mb_convert_case(trim(filter_var($_POST['adresse2'], FILTER_SANITIZE_STRING)), MB_CASE_TITLE, 'UTF-8') ?: null;

        if ($_POST['codeInsee']) {
            if (preg_match('/[0-9]{4,5}/', $_POST['codeInsee'])) {
                $user['codeInsee'] = $_POST['codeInsee'];
            }
        } else {
            throw new Exception('¯\_(シ)_/¯ => not valid or null codeInsee given');
        }

        $user['telPro'] = sanitizePhoneNumber($_POST['telPro']);
        $user['telPerso'] = sanitizePhoneNumber($_POST['telPerso']);
        $user['email'] = sanitizeEmail($_POST['email']);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

echo '<pre>';
var_dump($user);
echo '</pre>';