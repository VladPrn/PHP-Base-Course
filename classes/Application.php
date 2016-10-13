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
            if (!$message->validate() || !$this->saveMessage($message)) {
                $this->returnErrors($message->getErrors());
				$this->writeErrorToLog($message->getErrors());
            } 
        } else {
            $messages = $this->readMessages();
            $this->sendMessages($messages);
        }
    }
    
	//Сохранить новое сообщение
    private function saveMessage($message) {
        $messages = $this->readMessages();
        if ($messages == -1) {
            $messages = array();
        }
        $messages[] = $message;
        return file_put_contents(DATA_FILE, serialize($this->convertMessagesToArrays($messages))) == true;
    }
    
	//Прочитать сообщение
    private function readMessages() {
        $messages;
        if (file_exists(DATA_FILE)) {
            $messages = $this->convertMessagesFromArrays(unserialize(file_get_contents(DATA_FILE)));
            return $messages;
        } else {
            $this->writeErrorToLog('Can\'not find data file!');
            return array();
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