<?php
function getConfig() {
    $config = array();
    $config['DATA_FILE'] = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'DataBase.txt';
    $config['DATA_ERROR'] = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'Error.log';
    return $config;
}
?>