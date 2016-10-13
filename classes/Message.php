<?php
//Класс сообщения обычного пользователя
class Message implements IMessage {
    private $errors = array();
    public $name;
    public $text;
    public $date;

	//Конструктор
    public function __construct($message) {
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

	//Преобразовть к массиву
    public function toArray() {
        $arr = array();
        $arr['date'] = $this->date;
        $arr['name'] = $this->getName();
        $arr['text'] = $this->getText();
        return $arr;
    }
}