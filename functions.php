<?php
define('DATA_FILE', __DIR__ . '/data/DataBase.txt');
define('DATA_ERROR', __DIR__ . '/data/Error.log');

function readMessages() {
    $messages;
    if (file_exists(DATA_FILE)) {
        $messages = unserialize(file_get_contents(DATA_FILE));
        return $messages;
    } else {
        return -1;
    }
}

function saveMessage($message) {
    $messages = readMessages();
    if ($messages == -1) {
        $messages = array();
    }
    $messages[] = $message;
    file_put_contents(DATA_FILE, serialize($messages));
}

function writeErrorToLog($error) {
    $err = fopen(DATA_ERROR, 'a');
    fwrite($err, $error . PHP_EOL);
    fclose($err);
}

function sendMessages($messages) {
    header('Content-Type: application/json');
    echo json_encode($messages);
}
?>