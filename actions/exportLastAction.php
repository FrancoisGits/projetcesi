<?php
session_start();
require_once '../bin/config/database.php';
require_once './XMLHelper.php';

// Fetching users to export
try{
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
            LEFT JOIN insee i ON cl.inseeId = i.id
        WHERE cl.exported = 0';

    $query = $db->query($stmt);
    $result = $query->fetchAll();

// Exception if no new customer has registered
    if (empty($result)){
        throw new Exception('¯\_(シ)_/¯ => no new customer has registered yet, please try again later');
    }
} catch (Exception $e) {
    $_SESSION['error'] = true;
    /*header('Cache-Control: no-cache, must-revalidate');*/
    header('Refresh');
    /*header('Location:' . dirname(__DIR__) . '\index.php?export&error');*/
}

// xml handling
$file = dirname(__DIR__) . '\exports\\' . date('Y_m_d_His') . '_ConnectLife_new_customers_only.xml';
$handle = fopen($file, 'xb+');
$xmlHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n    <clients>\r\n";
$xmlFooter = "    </clients>\r\n</xml>";
$idsToUpdate = [];

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

    // updating users and mark them as exported
    foreach ($idsToUpdate as $idToUpdate) {
        $stmt = 'UPDATE connectlife.clients SET exported = 1 WHERE id=:id';
        $prep = $db->prepare($stmt);
        $prep->execute(['id' => $idToUpdate]);
    }
}