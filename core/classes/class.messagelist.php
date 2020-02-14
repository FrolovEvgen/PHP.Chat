<?php
// Пространство имен.
namespace WChat;

// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    DESCRIPTIONS
//------------------------------------------------------------------------------

/**
 * Класс <b>MessageList</b> -- без описания.
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
     * @return int
     */
    public function getUserFromId(): int
    {
        return $this->userFromId;
    }

    /**
     * @param int $userFromId
     */
    public function setUserFromId(int $userFromId)
    {
        $this->userFromId = $userFromId;
    }

    /**
     * @return int
     */
    public function getUserToId(): int
    {
        return $this->userToId;
    }

    /**
     * @param int $userToId
     */
    public function setUserToId(int $userToId)
    {
        $this->userToId = $userToId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setDateTime(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }
    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------
    /**
     * @var int
     */
    private $userFromId;
    /**
     * @var int
     */
    private $userToId;
    /**
     * @var string
     */
    private $message;
    /**
     * @var DateTime
     */
    private $dateTime;
}