<?php
//Интерфейс сообщения
interface IMessage {
    //Получить имя пользователя
    public function getName();
    
    //Получить текстовое сообщение пользователя
    public function getText();
    
    //Проверить на ошибки
    public function validate();
    
    //Получить массив ошибок
    public function getErrors();
    
    //Преобразовать к массиву
    public function toArray();
}
?>