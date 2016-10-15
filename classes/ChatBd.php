<?php
//Класс для взаимодействия с базой данных
class ChatBd {
    //Подключение к базе данных
    private static $pdo;
    
    //Подключиться к базе данных
   public static function connect() {
        $dsn = "mysql:host=localhost;dbname=chatbd;charset=utf8";
        $user = "root";
        $pass = "55555"; 
        self::$pdo = new PDO($dsn, $user, $pass);
   }
   
   //Прочитать сообщения пользователей из базы данных
   public static function readMessages() {
        $messages = array();
        $qMessages = self::$pdo->query('SELECT * FROM messages');
        while ($row = $qMessages->fetch())
        {
            $name = self::getUserNameById($row['id_user']);
            $messages[] = MessageFactory::createMessage(array("name" => $name, "text" => $row['text'], "date" => $row['date']));
        }
        return $messages;
   }
   
   //Сохранит сообщение пользователей в базу данных
   public static function saveMessage($message) {
        $qUserId = self::getUserIdByName($message->getName());
        $row = $qUserId->fetch();
        if ($row) {
            $userId = $row['id'];
        } else {
            $userId = self::createNewUser($message->getName());
        }
        if ($userId) {
             self::$pdo->query("INSERT INTO messages (id_user, text, date) VALUES('" . $userId . "', '" . $message->getText() . "', '" . $message->getDate() . "')");
             return false;
        }
        return true;
   }
   
   //Получить !результат запроса! идентификатора пользователя по его имени
    private static function getUserIdByName($name) {
        $qUserId = self::$pdo->query("SELECT (id) FROM users WHERE name='" . $name . "'");
        return $qUserId;
    }
   
    //Создать нового пользователя чата
    private static function createNewUser($name) {
        self::$pdo->query("INSERT INTO users (name) VALUES('" . $name . "')");
        $qUserId = self::getUserIdByName($name);
        $row = $qUserId->fetch();
        return $row['id'];
    }
   
   //Получить имя пользователя по его идентификатору
    private static function getUserNameById($id) {
        $qUserName = self::$pdo->query("SELECT (name) FROM users WHERE id='" . $id . "'");
        $row = $qUserName->fetch();
        return $row['name'];
    }
   
   //Закрыть соединение с базой данных
    public static function close() {
        self::$pdo = null;
    }
}