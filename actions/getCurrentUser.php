<?php
session_start();

if (isset($_SESSION['user'])){
    echo json_encode($_SESSION['user'], JSON_THROW_ON_ERROR, 512);
}
