<?php
include('functions.php');
include('config.php');
$config = getConfig();

$app = new Application($config);
$app->run();
?>