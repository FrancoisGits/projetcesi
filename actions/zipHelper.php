<?php

/**
 * Creates a zip file.
 * @param array $filesToZip
 * @param string $zipFilePath
 */
function createZip(array $filesToZip,string $zipFilePath){
    $zip = new ZipArchive;
    $res = $zip->open($zipFilePath, ZipArchive::CREATE);
    try {
        if ($res === true){
            foreach ($filesToZip as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        } else {
            throw new Exception("Error : zip file couldn't be created");
        }
    } catch (Exception $e){
        if (PRODUCTION === false){
            echo $e->getMessage();
        }
        addToLog($e->getMessage());
    }
}