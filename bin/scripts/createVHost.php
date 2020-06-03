<?php
require_once dirname(__DIR__) . '/config/config.php';

function editWindowsHostsFile(){
    $fileName = 'C:/Windows/System32/drivers/etc/hosts';
    $host = '127.0.0.1';
    echo "Editing hosts file \r\n";
    $hostsFileHandle = fopen($fileName, 'ab+');
    fwrite($hostsFileHandle, $host . '    ' . APP_NAME);
    echo 'added' . $host . '    ' . APP_NAME . "\r\n";
    fclose($hostsFileHandle);
    echo "success ! \r\n";
}

function createVirtualHost(){
    $vHostFileName = 'http-vhost.conf';
    $vHostFilePath = XAMP_PATH . '/apache/conf/extra/' . $vHostFileName;
    $vHost =
        '<VirtualHost *:80> 
    DocumentRoot "' . APP_ROOT . '"
    ServerName ' . APP_NAME . '
    ServerAlias *.' . APP_NAME . '
    <Directory "' . APP_ROOT . '">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>';

    $vHostFileHandle = fopen($vHostFilePath, 'ab+');
    echo "Editing xampp vhost hosts file \r\n";
    fwrite($vHostFileHandle, $vHost);
    echo 'added' . $vHost . "\r\n";
    fclose($vHostFileHandle);
    echo "success ! \r\n";
}

editWindowsHostsFile();
createVirtualHost();
