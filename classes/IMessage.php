<?php
//Интерфейс сообщения
interface IMessage {
    //Получить имя пользователя
    public function getName();
    
    //Получить текстовое сообщение пользователя
    public function getText();
    
    //Получить дату отправления
    public function getDate();
    
    //Получить имя пользователя (html-код)
    public function getHtmlName();
    
    //Получить текстовое сообщение пользователя (html-код)
    public function getHtmlText();
    
    //Проверить на ошибки
    public function validate();
    
    //Получить массив ошибок
    public function getErrors();
    
    //Преобразовать к массиву
    public function toArray();
}
?>