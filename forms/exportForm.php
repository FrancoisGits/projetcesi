<?php

echo "
<form class='formGroup'>
    <h1 id='downloadDisclaimer'>Cliquez sur un des boutons ci-dessous pour télécharger la liste utilisateurs ayant rempli le formulaire au format XML.</h1>";

if (isset($_SESSION['NoUsersToExport'])){
    echo "<h2 id='downloadDisclaimer'>Pas de nouvelles entrées dans le fichier, merci de réessayer plus tard</h2>";
}
echo "
    <button id='exportLastButton' formaction='../actions/exportLastAction.php' autofocus type='submit'>Exporter les derniers utilisateurs</button>
    <button id='exportAllButton' formaction='../actions/exportAllAction.php' type='submit'>Exporter tous les utilisateurs</button>
</form>";