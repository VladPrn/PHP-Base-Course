<?php
//Класс сообщения администратора
class AdminMessage extends Message {
    //Переопределенние метода
    public function getHtmlName() {
        return sprintf('%s%s%s', '<img src="Resources/img/admin.png"><b class="admin_name">', $this->name, '</b>');
    }

    //Переопределенние метода
    public function getHtmlText() {
        return sprintf('%s%s%s', '<span class="admin_text">', $this->text, '</span>');
    }
}