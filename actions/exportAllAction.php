<?php
require_once '../bin/config/database.php';
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

// xml handling
$file = dirname(__DIR__) . '\exports\\' . date('Y_m_d_His') . '_ConnectLife_all_customers.xml';
$handle = fopen($file, 'xb+');
$xmlHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n    <clients>\r\n";
$xmlFooter = "    </clients>\r\n</xml>";
fwrite($handle, $xmlHeader);
foreach ($result as $customer) {
    $idsToUpdate[] = $customer['id'];
    $user = formatDataIntoXML($customer);
    fwrite($handle, $user);
}
fwrite($handle, $xmlFooter);
fclose($handle);

// file download handling
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}