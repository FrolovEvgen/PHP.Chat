<?php
// Пространство имен.
namespace WChat;
use DateTime;

// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------

/**
 * Класс <b>Message</b> -- сообщение пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 0:36
 * @project PHP.Chat
 */
class Message
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    /**
     * Создает экземпляр класса <b>Message</b>.
     *
     * @param int $userId ИД пользователя.
     * @param string $message Сообщение пользователя.
     */
    public function __construct(int $userId, string $message)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->dateTime = time();
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * Получить ИД пользователя.
     *
     * @return int ИД пользователя.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Получить сообщение.
     *
     * @return string Сообщение.
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Получить дату/время сообщения.
     *
     * @return DateTime Дата-время сообщения.
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Получить форматированное время сообщения.
     * @return string
     */
    public function getTime() {
        // Если сообщению больше 24 ч. вывести дату.
        if(date('Y-m-d', $this->getDateTime()) < date('Y-m-d', time())) {
            return date('Y-m-d', $this->getDateTime());
        } else {
            // Если нет - вывести время.
            return date('h:i', $this->getDateTime());
        }
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * ИД пользователя.
     * @var int
     */
    private $userId;

    /**
     * Сообщение.
     * @var string
     */
    private $message;

    /**
     * Временная метка сообщения.
     * @var DateTime
     */
    private $dateTime;

}