<?php
class MessageFactory {
    public static function createMessage($message) {
        if ($message['name'] === 'admin') {
            return new AdminMessage($message);
        } else {
            return new Message($message);
        }
    }
}