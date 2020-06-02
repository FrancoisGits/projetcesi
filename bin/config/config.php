<?php
$content = json_decode(
    utf8_encode(
        file_get_contents(__DIR__ . '\config.json', FALSE, NULL)
    ),
    true,
    512
);


define('PRODUCTION', $content['production']);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('APP_ROOT', $content['url']);
define('XAMP_PATH', $content['xampp']['path']);
define('APP_NAME', $content['appName']);

if (PRODUCTION === false){
    error_reporting(-1);
}
ini_set('realpath_cache_size', '10M');
ini_set('memory_limit', '2G');
ini_set('post_max_size', '1G');
ini_set('upload_max_filesize', '512M');
ini_set('max_execution_time', '30');