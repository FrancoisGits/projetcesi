<?php
require_once '../bin/config/database.php';
require_once '../bin/config/logger.php';
require_once 'XMLHelper.php';

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

$query = $db->query($stmt);
$result = $query->fetchAll();

// XML handling
$file = dirname(__DIR__) . '\exports\\' . date('Y_m_d_His') . '_ConnectLife_all_customers.xml';
createXML($result, $file, false);

// file download handling
if (file_exists($file)) {
    $fileName = basename($file);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    addToLog("Export : file $fileName has been generated");
}