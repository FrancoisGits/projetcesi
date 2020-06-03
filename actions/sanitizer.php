<?php

/**
 * Returns sanitized phone number: strips non digit characters and adds french indicator if applicable
 * @param string $dirtyPhoneNumber
 * @return false|string|string[]|null
 */
function sanitizePhoneNumber(string $dirtyPhoneNumber){
    $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $dirtyPhoneNumber);

    if (strlen($cleanPhoneNumber) === 11){
          return substr_replace($cleanPhoneNumber, '0', 0, 2);
    }

    return $cleanPhoneNumber;
}

/**
 * returns filtered, trimmed, UTF-8 encoded and case converted string
 * @param string $dirtyString
 * @param $mbStyle
 * $mbStyle is mb_convert_case second parameter: MB_LOWER, MB_UPPER, MB_TITLE
 * @return string
 */
function sanitizeString(string $dirtyString, $mbStyle){

    return mb_convert_case(trim(filter_var($dirtyString, FILTER_SANITIZE_STRING)), $mbStyle, 'UTF-8');
}
