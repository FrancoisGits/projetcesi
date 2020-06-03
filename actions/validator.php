<?php
require_once './sanitizer.php';
require_once '../bin/config/logger.php';

/**
 * Validates a User
 */
function validateUser()
{
    try {
        if (!isset($_SESSION['user']['guid'])) {
            throw new Exception('Error : guid expected');
        }

        if (empty($_POST['civilite']) || !preg_match('/(M.|Mme)/', $_POST['civilite'])) {
            throw new Exception('Error : not valid or null civilite given');
        }

        validateFormField($_POST['nom'], 'nom');
        validateFormField($_POST['prenom'], 'prenom');
        validateFormField($_POST['adresse1'], 'adresse1');

        if (empty($_POST['codeInsee']) || !preg_match('/\d{3,5}/', $_POST['codeInsee'])) {
            throw new Exception('Error : not valid or null codeInsee given');
        }

        if ($_SESSION['user']['isSociete'] === '1') {
            validateFormField($_POST['societe'], 'societe');
            validateFormField($_POST['poste'], 'poste');
            validatePhone(sanitizePhoneNumber($_POST['telPro']));
            validatePhone(sanitizePhoneNumber($_POST['telPerso']));
        } else {
            if (!isset($_POST['telPro']) && empty($_POST['telPro']) && !isset($_POST['telPerso']) && empty($_POST['telPerso'])){
                throw new Exception('Error : at least 1 phone number is required');
            }
            if (isset($_POST['telPro'])){
                validatePhone($_POST['telPro']);
            } elseif (isset($_POST['telPerso'])){
                validatePhone($_POST['telPro']);
            }
        }
        validateEmail(sanitizeString($_POST['email'], MB_CASE_LOWER));
    } catch (Exception $e){
        if (PRODUCTION === false){
            echo $e->getMessage();
        }
        addToLog($e->getMessage());
    }

    return true;
}

/**
 * Validates a simple form field
 * @param $field
 * @throws Exception
 */
function validateFormField($field, $fieldName)
{
    if (!isset($field) || empty($field)) {
        throw new Exception("Error : $fieldName expected, null or empty value given");
    }
}

/**
 * Validates a sanitized phone number
 * @param $phone
 * @throws Exception
 */
function validatePhone($phone)
{
    if (!isset($phone) || empty($phone)){
        throw new Exception('Error : phone number expected, null given');
    }
    $phoneLength = strlen($phone);
    switch ($phoneLength) {
        case ($phoneLength < 10) === true:
            throw new Exception('Error : phone number too short');
            break;
        case ($phoneLength > 11) === true:
            throw new Exception('Error : phone number too long');
            break;
        case 10:
            if ($phone[0] !== '0') {
                throw new Exception('Error : invalid phone number format');
            }
            break;
        case 11:
            if (strpos($phone, '33') !== 0) {
                throw new Exception('Error : invalid phone number format');
            }
            break;
    }
}

/**
 * Validate an email address.
 * Provide email address (raw input)
 * Returns true if the email address has the email
 * address format and the domain exists.
 * From linuxjournal.com/article/9585
 *
 * @param $email
 * @return void
 * @throws Exception
 */
function validateEmail($email)
{
    $isValid = true;
    $atIndex = strrpos($email, '@');

    if (is_bool($atIndex) && !$atIndex) {
        $isValid = false;
    } else {
        $domain = substr($email, $atIndex + 1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);

        if ($localLen < 1 || $localLen > 64) {
            // local part length exceeded
            $isValid = false;
        } else if ($domainLen < 1 || $domainLen > 255) {
            // domain part length exceeded
            $isValid = false;
        } else if ($local[0] === '.' || $local[$localLen - 1] === '.') {
            // local part starts or ends with '.'
            $isValid = false;
        } else if (preg_match('/\\.\\./', $local)) {
            // local part has two consecutive dots
            $isValid = false;
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
            // character not valid in domain part
            $isValid = false;
        } else if (preg_match('/\\.\\./', $domain)) {
            // domain part has two consecutive dots
            $isValid = false;
        } else if
        (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
            str_replace("\\\\", '', $local))) {
            // character not valid in local part unless
            // local part is quoted

            if (!preg_match('/^"(\\\\"|[^"])+"$/',
                str_replace("\\\\", '', $local))) {
                $isValid = false;
            }
        }

        if ($isValid && !(checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A'))) {
            // domain not found in DNS
            $isValid = false;
        }
    }
    if ($isValid === false){
        throw new Exception('Error : invalid email format');
    }
}