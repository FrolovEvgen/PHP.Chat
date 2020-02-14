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
 * Класс <b>User</b> -- без описания.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 0:36
 * @project PHP.Chat
 */
class User
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    /**
     * User constructor.
     * @param string $username
     * @param string $iconname
     * @param string $lastmessage
     * @throws \Exception
     */
    public function __construct(string $username, string $iconname, string $lastmessage)
    {
        $this->userId = User::$ID++;
        $this->username = $username;
        $this->iconname = $iconname;
        $this->lastmessage = new Message($this->userId, $lastmessage);
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getIconname(): string
    {
        return $this->iconname;
    }

    /**
     * @param string $iconname
     */
    public function setIconname(string $iconname)
    {
        $this->iconname = $iconname;
    }

    /**
     * @return Message
     */
    public function getLastmessage(): Message
    {
        return $this->lastmessage;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->userId;
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
    private static $ID = 0;

    /**
     * @var int
     */
     private $userId;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $iconname;
    /**
     * @var Message
     */
    private $lastmessage;
}