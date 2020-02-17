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
     * Инициализация списка.
     */
    public function init() {
        // Определяем текущего пользователя.
        $currentUserId = Engine::$CURRENT_USER_ID;

        // Добавляем "переписку".
        $this->addMessage(1, $currentUserId, "Привет!;)");
        $this->addMessage(2, $currentUserId, "Привет!;)");
        $this->addMessage(3, $currentUserId, "Привет!;)");
        $this->addMessage(4, $currentUserId, "Привет!;)");
        $this->addMessage(5, $currentUserId, "Привет! Как дела?;)");
        $this->addMessage(6, $currentUserId, "Привет! Как дела?;)");
        $this->addMessage(7, $currentUserId, "Привет!;)");
        $this->addMessage(8, $currentUserId, "Привет!;)");
        $this->addMessage(9, $currentUserId, "=)");
        $this->addMessage(10, $currentUserId, "Привет!;)");
        $this->addMessage(1, 1, "О! Привет!");
        $this->addMessage(1, 1, "Как дела?");
        $this->addMessage(1, $currentUserId, "Нормально.. Сам как?");
        $this->addMessage(1, 1, "Та я вот сижу и домашку пилю.");
        $this->addMessage(1, 1, "А еще и приболел немного.");
        $this->addMessage(1, $currentUserId, "Что нового?");
        $this->addMessage(1, 1, "Та сваливаю на выхах.");
        $this->addMessage(2, 2, "Дарова братан!!!");
        $this->addMessage(3, 3, "Ты кто такой?!");
        $this->addMessage(4, 4, "Ты где пропал?!");
        $this->addMessage(5, 5, "Все норм! Только приехала..");
        $this->addMessage(6, 6, "Все нормально =)");
        $this->addMessage(7, 7, "Слушай..тут такая тема надо встретится..");
        $this->addMessage(8, 8, "Приветы!");
        $this->addMessage(9, 9, ";)");
        $this->addMessage(10, 10, "Неть меня ))))))))");
    }

    /**
     * Добавить сообщение в чат.
     *
     * @param int $chatId ИД чата.
     * @param int $userId ИД пользователя от которого отправляют сообщение.
     * @param string $message Сообщение
     */
    public function addMessage(int $chatId, int $userId, string $message) {
        // Генерируем ключ чата.
        $chatKey =  $this->getChatKey($chatId);

        // Проверяем есть ли уже созданный чат.
        if (!array_key_exists($chatKey  , $this->messages)) {
            // Если нет, то создадим.
            $this->messages[$chatKey] = array();
        }

        // Добавляем сообщение.
        array_push($this->messages[$chatKey], new Message($userId, $message));
    }

    /**
     * Получить список сообщений.
     *
     * @param int $chatId ИД чата.
     * @return array Список сообщений.
     */
    public function getMessages(int $chatId): array {
        // Генерируем ключ чата.
        $chatKey =  $this->getChatKey($chatId);

        // Проверяем есть ли уже созданный чат.
        if (array_key_exists($chatKey  , $this->messages)) {
            // Если есть, то вернем содержимое.
            return $this->messages[$chatKey];
        }
        return null;
    }

    /**
     * Получить последнее сообщение в чате.
     *
     * @param int $chatId ИД чата.
     * @return Message Сообщение.
     */
    public function getLastMessage(int $chatId): Message {
        // Получить сообщение.
        $messages = $this->getMessages($chatId);

        // Если есть сообщения.
        if ($messages != null) {
            // Вычисляем и выводим последнее.
            $total = count($messages);
            return $messages[$total - 1];
        }

        // Если нет возвращаем Null.
        return null;
    }

    /**
     *  Поиск сообщений по шаблону.
     *
     * @param string $search Шаблон поиска.
     * @return array Найденный сообщения.
     */
    public function search (string $search): array {
        $found = [];
        // Осуществляем поиск по шаблону.
        foreach ($this->messages as $key => $chat) {
            foreach ($chat as $message) {
                if (Engine::isConsist($message->getMessage(), $search)) {
                    array_push($found, $message);
                }
            }
        }
        // Чистим "уши".
        unset($key);
        unset($chat);
        unset($message);

        // Возвращаем результат.
        return $found;
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * сгенерировать ключ чата из ИД.
     *
     * @return String Сообщение.
     */
    private function getChatKey($id) {
        return "chat_$id";
    }

    /**
     * Массив чатов и сообщений.
     * @var array
     */
    private $messages = [];
}