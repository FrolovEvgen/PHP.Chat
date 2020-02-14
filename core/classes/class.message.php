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
 * Класс <b>Message</b> -- без описания.
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
     * Message constructor.
     * @param $userFromId int
     * @param $message string
     * @throws \Exception
     */
    public function __construct($userFromId, $message)
    {
        $this->userFromId = $userFromId;
        $this->message = $message;
        $this->dateTime = new \DateTime();
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * @return int
     */
    public function getUserFromId()
    {
        return $this->userFromId;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return string
     */
    public function getTime() {
        return "10:35";
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
     * @var string
     */
    private $message;

    /**
     * @var \DateTime
     */
    private $dateTime;

}