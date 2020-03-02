<?php
// Пространство имен.
namespace WChat;

// Попытка прочитать напрямую отправит в корень.
use mysqli_result;

if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------

/**
 * Класс <b>MessageList</b> -- список сообщений.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 10:31
 * @project PHP.Chat
 */
class MessageList
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * Получить список сообщений.
     *
     * @param int $userId ИД чата.
     * @return array Список сообщений.
     * @throws \Exception
     */
    public function getMessages(int $userId): array {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `messages` WHERE".
            " `from_id`=$userId OR `to_id`=$userId");
        return $this->parseMessageList($result);
    }

    /**
     * Получить последнее сообщение в чате.
     *
     * @param int $userId
     * @return Message | null Сообщение.
     * @throws \Exception
     */
    public function getLastMessage(int $userId) {
        $result = Engine::$DB->execQuery(
            "SELECT A.* FROM (SELECT * FROM `messages`" .
            " WHERE `from_id`=$userId OR `to_id`=$userId ORDER" .
            " BY `created` DESC) A LIMIT 1");
        $messageList = $this->parseMessageList($result);

        return count($messageList) > 0 ? $messageList[0] : null;
    }


    /**
     *  Поиск сообщений по шаблону.
     *
     * @param string $search Шаблон поиска.
     * @return array Найденный сообщения.
     * @throws \Exception
     */
    public function search (string $search): array {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `messages` WHERE message LIKE '%$search%';");
        return $this->parseMessageList($result);
    }

    /**
     * Добюавить сообщение.
     * @param int $fromId ИД пользователя "От кого".
     * @param int $toId ИД пользователя "Кому"
     * @param string $message Текст сообщения.
     * @return bool|mysqli_result Результат операции.
     */
    public function addMessage(int $fromId, int $toId,string $message) {
        $query = "INSERT INTO `messages` " .
            "(`id`, `from_id`, `to_id`, `message`, `created`)".
            "VALUES (NULL, $fromId, $toId, '$message', UNIX_TIMESTAMP());";
        return Engine::$DB->execQuery(trim($query));
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * Разобрать массив сообщений и сделать из них массив объектов.
     * @param mysqli_result $result Результат запроса БД.
     * @return array
     * @throws \Exception
     */
    private function parseMessageList(mysqli_result $result): array {
        $userList = [];

        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $messageData = mysqli_fetch_assoc($result);
            array_push($userList, $this->convertToMessage($messageData));
        }

        return $userList;
    }

    /**
     * Сконвертировать сообщение в объект.
     * @param array $messageData Данные сообщения.
     * @return Message Объект Сообщение.
     * @throws \Exception
     */
    private function convertToMessage(array $messageData): Message {
        return new Message(
            $messageData["id"],
            $messageData["from_id"],
            $messageData["to_id"],
            $messageData["message"],
            $messageData["created"]
        );
    }
}