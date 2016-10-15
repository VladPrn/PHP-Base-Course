<?php
//Класс сообщения обычного пользователя
class Message implements IMessage {
    private $errors = array();
    protected $name;
    protected $text;
    protected $date;

    //Конструктор
    public function __construct($message, $fromPost) {
        $this->name = $message['name'];
        $this->text = $message['text'];
        $this->date = isset($message['date']) ? $message['date'] : time();
    }

    //Получить массив ошибок
    public function getErrors() {
        return $this->errors;
    }

    //Проверить на ошибки
    public function validate() {
        if (empty($this->name)) {
            $this->errors['name'] = 'Не заполнено имя';
        }
        if (empty($this->text)) {
            $this->errors['text'] = 'Не заполнен текст сообщения';
        }
        return count($this->errors) == 0;
    }

    //Получить имя пользователя
    public function getName() {
        return $this->name;
    }

    //Получить текстовое сообщение пользователя
    public function getText() {
        return $this->text;
    }
    
    //Получить дату отправления
    public function getDate() {
        return $this->date;
    }

    //Получить имя пользователя (html-код)
    public function getHtmlName() {
        return $this->name;
    }
    
    //Получить текстовое сообщение пользователя (html-код)
    public function getHtmlText() {
        return $this->text;
    }

    //Преобразовть к массиву
    public function toArray() {
        $arr = array();
        $arr['date'] = $this->date;
        $arr['name'] = $this->getHtmlName();
        $arr['text'] = $this->getHtmlText();
        return $arr;
    }
}