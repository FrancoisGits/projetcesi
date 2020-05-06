<?php
session_start();
require './bin/config/config.php';
require_once './bin/config/database.php';
require './includes/header.php';

//$request = $_SERVER['REQUEST_URI'];
//
//switch ($request) {
//    case '/' || '':
//        require __DIR__ . '/index.php';
//        break;
//    case '/'.preg_match() :
//        require __DIR__ . '/views/about.php';
//        break;
//    default:
//        http_response_code(404);
//        require __DIR__ . '/views/404.php';
//        break;
//}

//require './forms/knownUserForm.php';
require './forms/updateUserForm.php';
require_once './includes/footer.php';