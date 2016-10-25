<?php
class Application {
    //Конструктор
    public function __construct($config) {
        foreach ($config as $i => $value) {
            define($i, $value);
        }
    }

    //Запуск программы
    public function run() {
        if (isset($_POST['message'])) {
            $message = MessageFactory::createMessage($_POST['message']);
            $bd = new ChatBd(BD_URL, BD_NAME, BD_USER, BD_PASS);
            if (!$message->validate() || $bd->saveMessage($message)) {
                $this->returnErrors($message->getErrors());
                $this->writeErrorToLog($message->getErrors());
            }
        } else {
            $bd = new ChatBd(BD_URL, BD_NAME, BD_USER, BD_PASS);
            $messages = $bd->readMessages();
            $this->sendMessages($messages);
        }
    }
    
    //Отправить сообщения клиенту
    private function sendMessages($messages) {
        header('Content-Type: application/json');
        $data = $this->convertMessagesToArrays($messages);
        echo json_encode($data);
    }
    
    //Преобразовть сообщение в вид для хранения в файле 
    private function convertMessagesToArrays($messages) {
        for ($i = 0; $i < count($messages); $i++) {
            $messages[$i] = $messages[$i]->toArray();
        }
        return $messages;
    }
    
    //Преобразовть сообщение из вида для хранения в файле 
    private function convertMessagesFromArrays($arrays) {
        for ($i = 0; $i < count($arrays); $i++) {
            $arrays[$i] = MessageFactory::createMessage($arrays[$i]);
        }
        return $arrays;
    }
    
    //Вернуть ошибку клиенту
    private function returnErrors($errors) {
        header('HTTP/1.1 400 Bad Request');
        echo implode("\n", $errors);
    }
    
    //Записать ошибку в лог
    private function writeErrorToLog($error) {
        $err = fopen(DATA_ERROR, 'a');
        fwrite($err, $error . PHP_EOL);
        fclose($err);
    }
}
?>