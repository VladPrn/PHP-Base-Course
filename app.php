<?php
include('functions.php');

if (isset($_POST['addedText'])) {
    saveMessage($_POST['addedText']);
} else {
    $messages = readMessages();
    if ($messages != -1) {
        sendMessages($messages);
    } else {
        writeErrorToLog(date('m/d/Y H:i:s', time()) . '->Could not find database file. File will be create!');
        fopen(DATA_FILE, 'w');
        fclose(DATA_FILE);
    }
}
?>