<?php
function getConfig() {
    $config = array();
    $config['DATA_FILE'] = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'DataBase.txt';
    $config['DATA_ERROR'] = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'Error.log';
	$config['BD_URL'] = 'localhost';
	$config['BD_NAME'] = 'chatbd';
	$config['BD_USER'] = 'chatuser';
	$config['BD_PASS'] = 'password';
    return $config;
}
?>