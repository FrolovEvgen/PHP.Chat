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
     * @param int $id
     * @param int $fromId
     * @param int $toId
     * @param string $message Сообщение пользователя.
     * @param int $dateTime
     * @throws \Exception
     */
    public function __construct(int $id, int $fromId, int $toId, string $message, int $dateTime)
    {
        $this->id = $id;
        $this->fromId = $fromId;
        $this->toId = $toId;
        $this->message = $message;
        $this->dateTime = new DateTime();
        $this->dateTime->setTimestamp($dateTime);
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFromId(): int {
        return $this->fromId;
    }

    /**
     * Получить ИД пользователя.
     *
     * @return int ИД пользователя.
     */
    public function getToId(): int {
        return $this->toId;
    }

    /**
     * Получить сообщение.
     *
     * @return string Сообщение.
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * Получить дату/время сообщения.
     *
     * @return DateTime Дата-время сообщения.
     */
    public function getDateTime(): DateTime {
        return $this->dateTime;
    }

    /**
     * Получить форматированное время сообщения.
     * @return string
     */
    public function getTime(): string {
        // Если сообщению больше 24 ч. вывести дату.
        if(date('Y-m-d', $this->getDateTime()->getTimestamp()) < date('Y-m-d', time())) {
            return date('Y-m-d', $this->getDateTime()->getTimestamp());
        } else {
            // Если нет - вывести время.
            return date('h:i', $this->getDateTime()->getTimestamp());
        }
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------


    private $id;

    /**
     * ИД отправителя.
     * @var int
     */
    private $fromId;

    /**
     * ИД получателя.
     * @var int
     */
    private $toId;

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