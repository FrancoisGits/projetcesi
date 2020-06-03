<?php

/**
 * @param array $customers
 * @param string $filePath
 * @param bool $updateCustomers
 * @return array
 */
function createXML(array $customers, string $filePath, bool $updateCustomers){
    $xml = new DomDocument('1.0', 'utf-8');
    $xml->formatOutput = true;
    // ajouter le fichier .xsd dans le fichier xml avec le xsi:NoNamespaceSchemaLocation
    $xsd = $xml->createElement('clients');
    $xml->appendChild($xsd);
    $xsd->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
    $xsd->setAttribute("xsi:noNamespaceSchemaLocation", "connectlife_customers.xsd");

    foreach ($customers as $customer) {
        if ($updateCustomers) {
            $idsToUpdate[] = $customer['id'];
        }

        $customerTag = $xml->createElement('client');
        $xsd->appendChild($customerTag);
        $customerTag->setAttribute('id', $customer['id']);

        $guid = $xml->createElement('guid', ($customer['guid']));
        $customerTag->appendChild($guid);

        $civilite = $xml->createElement('civilite', $customer['civilite']);
        $customerTag->appendChild($civilite);

        $nom = $xml->createElement('nom', $customer['nom']);
        $customerTag->appendChild($nom);

        $prenom = $xml->createElement('prenom', $customer['prenom']);
        $customerTag->appendChild($prenom);

        $adresse1 = $xml->createElement('adresse1', $customer['adresse1']);
        $customerTag->appendChild($adresse1);

        $adresse2 = $xml->createElement('adresse2', $customer['adresse2']);
        $customerTag->appendChild($adresse2);

        $inseeTag = $xml->createElement('insee');
        $inseeTag->setAttribute('id', $customer['inseeId']);
        $customerTag->appendChild($inseeTag);

        $cp = $xml->createElement('codePostal', $customer['cp']);
        $inseeTag->appendChild($cp);

        $ville = $xml->createElement('ville', $customer['ville']);
        $inseeTag->appendChild($ville);

        $complement = $xml->createElement('complement', $customer['complement']);
        $inseeTag->appendChild($complement);

        $telephone1 = $xml->createElement('telephone1', $customer['telephone1']);
        $customerTag->appendChild($telephone1);

        $telephone2 = $xml->createElement('telephone2', $customer['telephone2']);
        $customerTag->appendChild($telephone2);

        $email = $xml->createElement('email', $customer['email']);
        $customerTag->appendChild($email);

        if (empty($customer['societe'])) {
            $nomSociete = $xml->createElement('societe', $customer['societe']);
            $customerTag->appendChild($nomSociete);

            $poste = $xml->createElement('poste', $customer['poste']);
            $customerTag->appendChild($poste);
        }
    }

    $xml->save($filePath);

    if ($updateCustomers) {
        return $idsToUpdate;
    }
}