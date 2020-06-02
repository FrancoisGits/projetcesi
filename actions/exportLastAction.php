<?php
session_start();
require_once '../bin/config/database.php';
require_once '../bin/config/logger.php';
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
        $_SESSION['NoUsersToExport'] = true;
        throw new Exception('Error : no new customer has registered yet, please try again later');
    }
} catch (Exception $e) {
    if (PRODUCTION === false){
        echo $e->getMessage();
    }
    addToLog($e->getMessage());
    header('Location:' . APP_ROOT . '/export-users');
}

// XML handling
$file = dirname(__DIR__) . '\exports\\' . date('Y_m_d_His') . '_ConnectLife_new_customers_only.xml';
$idsToUpdate = createXML($result, $file, true);

// file download handling
if (file_exists($file)) {
    $fileName = basename($file);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    addToLog("Export : file $fileName has been generated");

    // updating users and mark them as exported
    foreach ($idsToUpdate as $idToUpdate) {
        $stmt = 'UPDATE connectlife.clients SET exported = 1 WHERE id=:id';
        $prep = $db->prepare($stmt);
        $prep->execute(['id' => $idToUpdate]);
        addToLog("Updated : user with id $idToUpdate");
    }
}