<?php
require 'emailValidator.php';

/**
 * Returns sanitized phone number: strips non digit characters and adds french indicator if applicable
 * @param string $dirtyPhoneNumber
 * @return false|string|string[]|null
 * @throws Exception
 */
function sanitizePhoneNumber(string $dirtyPhoneNumber){
    if ($dirtyPhoneNumber === null) {
        throw new Exception('¯\_(シ)_/¯ => string parameter needed, null given');
    }

    $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $dirtyPhoneNumber);

    if (strlen($cleanPhoneNumber) < 10){
        throw new Exception('¯\_(シ)_/¯ => invalid phone number format, not enough characters: 10 minimum');
    }

    if (strlen($cleanPhoneNumber) === 10) {
        if ($cleanPhoneNumber[0] !== '0'){
            throw new Exception('¯\_(シ)_/¯ => invalid phone number format, must start with 0 or 33');
        }

        return '33' . substr($cleanPhoneNumber,1);
    }

    if (strlen($cleanPhoneNumber) > 10){
        if (substr($cleanPhoneNumber, 0, 2) !== '33'){
            throw new Exception('¯\_(シ)_/¯ => invalid phone number format, must start with 0 or 33\');');
        }
        if (strlen($cleanPhoneNumber) > 11){
            throw new Exception('¯\_(シ)_/¯ => invalid phone number format, too many characters: 11 maximum');
        }

        return $cleanPhoneNumber;
    }
}

function sanitizeEmail(string $dirty){
    if ($dirty === null){
        throw new Exception('¯\_(シ)_/¯ => string parameter needed, null given');
    }
    if (!validEmail($dirty)) {
        throw new Exception('¯\_(シ)_/¯ => invalid email format');
    }

    return mb_convert_case(trim($dirty), MB_CASE_LOWER, 'UTF-8');

}

/**
 * returns filtered, trimmed, UTF-8 encoded and case converted string
 * @param string $dirty
 * @param $mbStyle
 * $mbStyle is mb_convert_case second parameter: MB_LOWER, MB_UPPER, MB_TITLE
 * @return string
 * @throws Exception
 */
function sanitizeString(string $dirty, $mbStyle){
    if ($dirty === null){
        throw new Exception('¯\_(シ)_/¯ => string parameter needed, null given');
    }

    return mb_convert_case(trim(filter_var($dirty, FILTER_SANITIZE_STRING)), $mbStyle, 'UTF-8');
}
