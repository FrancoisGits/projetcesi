<?php
if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['nom'];
    $firstName = $_SESSION['user']['prenom'];
    $gender = $_SESSION['user']['civilite'];

    session_destroy();
    session_unset();

    echo "<div class=\"thanks\">
    <h1>Merci, $gender $firstName $name !</h1>
    <p>Vous avez bien rempli le formulaire et vos données sont maintenant à jour. À bientôt !</p>    
</div>";
}