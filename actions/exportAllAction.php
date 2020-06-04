<?php
require_once '../bin/config/config.php';
require_once '../bin/config/database.php';
require_once '../bin/config/logger.php';
require_once 'XMLHelper.php';
require_once 'zipHelper.php';

// Fetching all users
$stmt = 'SELECT cl.id, 
               cl.civilite, 
               cl.nom, 
               cl.prenom, 
               cl.adresse1, 
               cl.adresse2, 
               cl.telephone1, 
               cl.telephone2, 
               cl.email, 
               cl.societe, 
               cl.poste, 
               cl.guid, 
               cl.exported, 
               i.id as `inseeId`, 
               i.cp, 
               i.ville, 
               i.complement
        FROM connectlife.clients cl 
            LEFT JOIN insee i ON cl.inseeId = i.id';
$_SESSION['noUsersToExport'] = false;

$query = $db->query($stmt);
$result = $query->fetchAll();

// XML, XSD and zip handling
$file = ROOT . 'exports/' . date('Y_m_d_His') . '_ConnectLife_all_customers.xml';
$fileXsd = ROOT . 'exports/' . 'connectlife_customers.xsd';
$zipFilePath = ROOT . 'exports/' . date('Y_m_d_His') . '_ConnectLife_all_customers.zip';
createXML($result, $file, false);
$filesToZip = array($file, $fileXsd);
createZip($filesToZip, $zipFilePath);

// file download handling
if (file_exists($zipFilePath)) {
    $fileName = basename($zipFilePath);
    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($zipFilePath));
    readfile($zipFilePath);
    addToLog("Export : file $fileName has been generated");
    unlink($zipFilePath);
}