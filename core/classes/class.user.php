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
     * @param string $username Имя пользователя.
     * @param string $iconname Название иконки пользователя.
     * @param string $phone Телефон пользователя.
     * @param string $email ЕМейл пользователя.
     */
    public function __construct(
        string $username,
        string $iconname,
        string $phone,
        string $email)
    {
        // "Генерируем" ИД пользователя.
        $this->userId = User::$ID++;

        // сохраняем данные полей.
        $this->setUsername($username);
        $this->setIconname($iconname);
        $this->setEmail($email);
        $this->setPhone($phone);
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
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
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
     */
    public function setIconname(string $iconname)
    {
        $this->iconname = $iconname;
    }

    /**
     * Получить телефон пользователя.
     *
     * @return string Телефон пользователя.
     */
    function getPhone(): string {
        return $this->phone;
    }

    /**
     * Сохранить телефон пользователя.
     *
     * @param string $phone Телефон пользователя.
     */
    function setPhone(string $phone) {
        $this->phone = $phone;
    }

    /**
     * Получить ЕМейл пользователя.
     * @return string ЕМейл пользователя.
     */
    function getEmail(): string {
        return $this->email;
    }

    /**
     * Задать ЕМейл пользователя.
     * @param string $email ЕМейл пользователя.
     */
    function setEmail(string $email) {
        $this->email = $email;
    }

    /**
     * Получить ИД пользователя.
     *
     * @return int Ид пользователя.
     */
    public function getId(): int {
        return $this->userId;
    }
    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------
    /**
     * Счетчик пользователей.
     * @var int
     */
    private static $ID = 1;

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
     * Иконка пользователя.
     * @var string
     */
    private $iconname;

    /**
     * Телефон пользователя.
     * @var string
     */
    private $phone;

    /**
     * ЕМейл пользователя.
     * @var string
     */
    private $email;
}