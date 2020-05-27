<?php
session_start();
require './bin/config/config.php';
require_once './bin/config/database.php';
require './includes/header.php';
//

//var_dump($_GET);
//$request = $_SERVER['REQUEST_URI'];
//var_dump($request);

//switch ($request){
//    case preg_match('/^\/fic\?q=([a-z\d]{8}-[a-z\d]{4}-[a-z\d]{4}-[a-z\d]{4}-[a-z\d]{12})/', $request) == 1 :
//        echo ' match';
//        break;
//    default:
//        echo 'defaut';
//        break;
//}

/*
switch ($request) {
    case '/' || '':
        require __DIR__ . '/index.php';
        break;
    case '/'.preg_match() :
        require __DIR__ . '/views/about.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}*/
require './forms/exportForm.php';
//require './forms/knownUserForm.php';
//require './forms/updateUserForm.php';
require_once './includes/footer.php';