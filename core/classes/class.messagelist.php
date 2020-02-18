<?php
// Пространство имен.
namespace WChat;

// Попытка прочитать напрямую отправит в корень.
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
     * @param int $chatId ИД чата.
     * @return Message Сообщение.
     */
    public function getLastMessage(int $userId): Message {
        $result = Engine::$DB->execQuery(
            "SELECT A.* FROM (SELECT * FROM `messages` WHERE `from_id`=$userId OR `to_id`=$userId ORDER BY `created` DESC) A LIMIT 1");
        $messageList = $this->parseMessageList($result);

        return count($messageList) > 0 ? $messageList[0] : null;
    }


    /**
     *  Поиск сообщений по шаблону.
     *
     * @param string $search Шаблон поиска.
     * @return array Найденный сообщения.
     */
    public function search (string $search): array {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `messages` WHERE message LIKE '%$search%';");
        return $this->parseMessageList($result);
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    private function parseMessageList($result): array {
        $userList = [];

        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $messageData = mysqli_fetch_assoc($result);
            array_push($userList, $this->convertToMessage($messageData));
        }

        return $userList;
    }

    private function convertToMessage($messageData): Message {
        return new Message(
            $messageData["id"],
            $messageData["from_id"],
            $messageData["to_id"],
            $messageData["message"],
            $messageData["created"]
        );
    }
}