<?php
//Класс для взаимодействия с базой данных
class ChatBd {
    //Подключение к базе данных
    private $pdo;
    
    //Подключиться к базе данных
   public function __construct($url, $dbname, $user, $pass) {
        $dsn = "mysql:host=" . $url . ";dbname=" . $dbname . ";charset=utf8";
        $this->pdo = new PDO($dsn, $user, $pass);
   }
   
   //Прочитать сообщения пользователей из базы данных
   public function readMessages() {
        $messages = array();
        $qMessages = $this->pdo->query('SELECT * FROM messages');
        while ($row = $qMessages->fetch())
        {
            $name = $this->getUserNameById($row['id_user']);
            $messages[] = MessageFactory::createMessage(array("name" => $name, "text" => $row['text'], "date" => $row['date']));
        }
        return $messages;
   }
   
   //Сохранит сообщение пользователей в базу данных
   public function saveMessage($message) {
        $qUserId = $this->getUserIdByName($message->getName());
        $row = $qUserId->fetch();
        if ($row) {
            $userId = $row['id'];
        } else {
            $userId = $this->createNewUser($message->getName());
        }
        if ($userId) {
             $this->pdo->query("INSERT INTO messages (id_user, text, date) VALUES('" . $userId . "', '" . $message->getText() . "', '" . $message->getDate() . "')");
             return false;
        }
        return true;
   }
   
   //Получить !результат запроса! идентификатора пользователя по его имени
    private function getUserIdByName($name) {
        $qUserId = $this->pdo->query("SELECT (id) FROM users WHERE name='" . $name . "'");
        return $qUserId;
    }
   
    //Создать нового пользователя чата
    private function createNewUser($name) {
        $this->pdo->query("INSERT INTO users (name) VALUES('" . $name . "')");
        $qUserId = $this->getUserIdByName($name);
        $row = $qUserId->fetch();
        return $row['id'];
    }
   
   //Получить имя пользователя по его идентификатору
    private function getUserNameById($id) {
        $qUserName = $this->pdo->query("SELECT (name) FROM users WHERE id='" . $id . "'");
        $row = $qUserName->fetch();
        return $row['name'];
    }
   
   //Закрыть соединение с базой данных
    public function __destruct() {
        $this->pdo = null;
    }
}