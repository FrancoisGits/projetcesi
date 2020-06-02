<?php

echo "<form action='" . APP_ROOT . "' class='formGroup errorSection'>
    <h2>Mince !</h2>
    <h1>Votre e-mail a changé ?</h1>
    <p>Si vous utilisez toujours l'adresse e-mail sur laquelle vous avez reçu le lien, merci de continuer à l'utiliser.
        Si vous souhaitez changer, merci de contacter le service de mass-mailing. N'oubliez pas qu'en regard de la loi
        sur le RGPD, vous disposez d'un droit d'accès et de modification des données vous concernant.</p>
    <button autofocus type='submit' name='backFromInvalidEmail' value='true'>Revenir</button></a>
</form>";