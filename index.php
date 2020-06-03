<?php
session_start();

require_once './bin/config/config.php';
require_once './bin/config/logger.php';
require_once './bin/config/database.php';
require_once './actions/userCheckHelper.php';
require './includes/header.php';



if (isset($_POST['disclaimer']) && $_POST['disclaimer'] !== false){
    $request = '/forms';
} else if (isset($_SESSION['submittedForm']) && $_SESSION['submittedForm'] !== false) {
    $request = '/thanks';
} else if (isset($_GET['backFromInvalidEmail']) && $_GET['backFromInvalidEmail'] === 'true'){
    $request = '/forms';
} else {
    $request = $_SERVER['REQUEST_URI'];
}

switch ($request){
    case preg_match('/^\/fic\?q=([a-z\d]{8}-[a-z\d]{4}-[a-z\d]{4}-[a-z\d]{4}-[a-z\d]{12})/', $request) === 1 :
        $userChecked = checkUser($_GET['q'], $db);
        switch ($userChecked) {
            case 'none':
                http_response_code(403);
                require_once './includes/403.php';
                break;
            case 'existing':
                http_response_code(403);
                $_SESSION['user']['existing'] = true;
                require_once './forms/knownUserForm.php';
                break;
            default :
                $_SESSION['user'] = $userChecked;
                $userGuid = $_SESSION['user']['guid'];
                $userName = $_SESSION['user']['nom'];
                addToLog("Connected : $userGuid $userName");
                require_once './includes/homeDisclaimer.php';
                break;
        }
        break;
    case '/forms':
        require_once './forms/updateUserForm.php';
        break;
    case '/thanks':
        require_once './includes/thanks.php';
        break;
    case '/invalidEmail':
        require_once './includes/invalidEmail.php';
        break;
    case '/export-users':
        require_once './forms/exportForm.php';
        break;
    default:
        http_response_code(404);
        require_once './includes/404.php';
        break;
}

require_once './includes/footer.php';