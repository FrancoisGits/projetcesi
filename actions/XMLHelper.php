<?php

function formatDataIntoXML(array $customer){
    if (empty($customer['societe'])) {
        $user = '        <client id="' . $customer['id'] . '">
            <type>Particulier</type>
            <civilite>' . $customer['civilite'] . '</civilite>
            <nom>' . $customer['nom'] . '</nom>
            <prenom>' . $customer['prenom'] . '</prenom>
            <adresse1>' . $customer['adresse1'] . '</adresse1>
            <adresse2>' . $customer['adresse2'] . '</adresse2>
            <insee id="' . $customer['inseeId'] . '">
                <cp>' . $customer['cp'] . '</cp>
                <ville>' . $customer['ville'] . '</ville>
                <complement>' . $customer['complement'] . '</complement>
            </insee>
            <telephone1>' . $customer['telephone1'] . '</telephone1>
            <email>' . $customer['email'] . '</email>
            <guid>' . $customer['guid'] . '</guid>
        </client>' . "\r\n";
    } else {
        $user = '        <client id="' . $customer['id'] . '">
            <type>Société</type>
            <civilite>' . $customer['civilite'] . '</civilite>
            <nom>' . $customer['nom'] . '</nom>
            <prenom>' . $customer['prenom'] . '</prenom>
            <adresse1>' . $customer['adresse1'] . '</adresse1>
            <adresse2>' . $customer['adresse2'] . '</adresse2>
            <insee id="' . $customer['inseeId'] . '">
                <cp>' . $customer['cp'] . '</cp>
                <ville>' . $customer['ville'] . '</ville>
                <complement>' . $customer['complement'] . '</complement>
            </insee>
            <telephone1>' . $customer['telephone1'] . '</telephone1>
            <telephone2>' . $customer['telephone2'] . '</telephone2>
            <email>' . $customer['email'] . '</email>
            <societe>' . $customer['societe'] . '</societe>
            <poste>' . $customer['poste'] . '</poste>
            <guid>' . $customer['guid'] . '</guid>
        </client>' . "\r\n";
    }
    return $user;
}