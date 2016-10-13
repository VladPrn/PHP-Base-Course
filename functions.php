<?php
//Функция автозагрузки классов
function __autoload($className) {
    $filePath = sprintf('%s%sclasses%s%s.php', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $className);
    if (file_exists($filePath)) {
        require_once $filePath;
    }
}
?>