<?php
if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['nom'];

    echo "<form action='./index.php' method='post' class=\"homeDisclaimer formGroup\">
    <h1>Cher.e, M./Mme $name</h1>
    <p>Vous êtes client chez nous et nous vous en remercions. ConnectLife modernise ses installations informatiques et
        passe à la vitesse supérieure avec sa nouvelle base de donnée. Plus puissante, plus flexible, plus complète.
    Nous souhaitons transférer les données vous concernant vers ces nouveaux systèmes et pour exploiter pleinement
        nos nouvelles ressources, nous avons besoin d'un peu plus d'informations sur vous. Si vous êtes d'accord, vous
        pouvez cliquer sur le bouton \"suivant\" ci-dessous et remplir le formulaire.</p>
    <span class=\"rgpd\">Conformément au RGPD, vous disposez d'un droit d'accès et de modification sur vos données, pour ce faire merci de nous contacter directement</span>
    <button autofocus class='next' name='disclaimer' value='true' type='submit'>Suivant</button>    
</form>";
}
