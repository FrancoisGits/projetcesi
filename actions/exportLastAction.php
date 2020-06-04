<?php
session_start();
require_once '../bin/config/config.php';
require_once '../bin/config/database.php';
require_once '../bin/config/logger.php';
require_once 'XMLHelper.php';
require_once 'zipHelper.php';

// Fetching users to export
try {
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
    if (empty($result)) {
        $_SESSION['noUsersToExport'] = true;
        throw new Exception('Error : no new customer has registered yet, please try again later');
    }
    $_SESSION['noUsersToExport'] = false;

} catch (Exception $e) {
    if (PRODUCTION === false) {
        echo $e->getMessage();
    }
    addToLog($e->getMessage());
    header('Location:' . APP_ROOT . '/export-users');
}

// XML handling
if ($_SESSION['noUsersToExport'] === false) {
    $file = ROOT . 'exports/' . date('Y_m_d_His') . '_ConnectLife_new_customers_only.xml';
    $idsToUpdate = createXML($result, $file, true);
    $fileXsd = ROOT . 'exports/' . 'connectlife_customers.xsd';
    $zipFilePath = ROOT . 'exports/' . date('Y_m_d_His') . '_ConnectLife_new_customers_only.zip';
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

        // updating users and mark them as exported
        foreach ($idsToUpdate as $idToUpdate) {
            $stmt = 'UPDATE connectlife.clients SET exported = 1 WHERE id=:id';
            $prep = $db->prepare($stmt);
            $prep->execute(['id' => $idToUpdate]);
            addToLog("Updated : user with id $idToUpdate");
        }
    }
}