<?php
// Пространство имен.
namespace WChat;

// Попытка прочитать напрямую отправит в корень.
use DateTime;
use Exception;

if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------

/**
 * Класс <b>User</b> -- данные пользователя.
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
     * Создать экземпляр класса <b>User</b>.
     *
     * @param int $userId
     */
    public function __construct(
        int $userId)
    {
        // "Генерируем" ИД пользователя.
        $this->userId = $userId;
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * Получить имя пользователя.
     *
     * @return string Имя пользователя.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Сохранить имя пользователя.
     *
     * @param string $username Имя пользователя.
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Получить иконку пользователя.
     *
     * @return string Иконка пользователя.
     */
    public function getIconname(): string
    {
        return $this->iconname;
    }

    /**
     * Сохранить иконку пользователя.
     *
     * @param string $iconname Иконка пользователя.
     * @return User
     */
    public function setIconname(string $iconname): User
    {
        $this->iconname = $iconname;
        return $this;
    }

    /**
     * Получить телефон пользователя.
     *
     * @return string Телефон пользователя.
     */
    function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Сохранить телефон пользователя.
     *
     * @param string $phone Телефон пользователя.
     * @return User
     */
    function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Получить ЕМейл пользователя.
     * @return string ЕМейл пользователя.
     */
    function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Задать ЕМейл пользователя.
     * @param string $email ЕМейл пользователя.
     * @return User
     */
    function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Получить ИД пользователя.
     *
     * @return int Ид пользователя.
     */
    public function getId(): int
    {
        return $this->userId;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param int $created
     * @return User
     * @throws Exception
     */
    public function setCreated(int $created): User
    {
        $this->created = new DateTime();
        $this->created->setTimestamp($created);
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param int $updated
     * @return User
     * @throws Exception
     */
    public function setUpdated(int $updated): User
    {
        $this->updated = new DateTime();
        $this->updated->setTimestamp($updated);
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastactivity(): DateTime
    {
        return $this->lastactivity;
    }

    /**
     * @param DateTime $lastactivity
     * @return User
     * @throws Exception
     */
    public function setLastactivity(int $lastactivity): User
    {
        $this->lastactivity = new DateTime();
        $this->lastactivity->setTimestamp($lastactivity);
        return $this;
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
     * Имя пользователя.
     * @var string
     */
    private $username;

    /**
     * ЕМейл пользователя.
     * @var string
     */
    private $email;

    /**
     * Телефон пользователя.
     * @var string
     */
    private $phone;

    /**
     * Иконка пользователя.
     * @var string
     */
    private $iconname;

    /**
     * Временная метка сообщения.
     * @var DateTime
     */
    private $created;

    /**
     * Временная метка сообщения.
     * @var DateTime
     */
    private $updated;

    /**
     * Временная метка сообщения.
     * @var DateTime
     */
    private $lastactivity;


}