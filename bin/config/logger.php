<?php

/**
 * Adds the message to a log file.
 * @param $message
 */
function addToLog(string $message){
    $lineToInsert = '[' .  date('Y_m_d_H:i:s') . ']' . ' ' . $message . "\r\n";
    $location = ROOT . 'logs/';
    $file = $location . date('Y_m_d') . '_connectLife.log';
    $handle = fopen($file, 'ab+');
    fwrite($handle, $lineToInsert);
    fclose($handle);
}