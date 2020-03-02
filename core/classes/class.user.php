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
     * @param int $userId Ид пользователя.
     * @param string $hpassword Хэш пароля.
     */
    public function __construct(int $userId, string $hpassword)
    {
        // "Генерируем" ИД пользователя.
        $this->userId = $userId;
        $this->hpasswd = $hpassword;
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
     * Получить дату создания пользователя.
     * @return DateTime ДатаВремя создания.
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Сохранить дату создания пользователя.
     * @param int $created ДатаВремя создания.
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
     * Получить дату время обновления пользователя.
     * @return DateTime ДатаВремя обносления данных.
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * Сохранить дату обновления пользователя.
     * @param int $updated ДатаВремя обновления пользователя.
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
     * Получить время последней активности пользователя.
     * @return DateTime ДатаВремя последней активности.
     */
    public function getLastactivity(): DateTime
    {
        return $this->lastactivity;
    }

    /**
     * Сохранить время последней активности пользователя.
     * @param int $lastactivity ДАтаВремя последней активности.
     * @return User
     * @throws Exception
     */
    public function setLastactivity(int $lastactivity): User
    {
        $this->lastactivity = new DateTime();
        $this->lastactivity->setTimestamp($lastactivity);
        return $this;
    }

    /**
     * Проверить валидность пароля пользователя.
     * @param string $password Пароль пользователя.
     * @return bool Результат проверки.
     */
    public function isPassValid(string $password) {
        return password_verify($password, $this->hpasswd);
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
     * Временная метка создания
     * @var DateTime
     */
    private $created;

    /**
     * Временная метка обновления.
     * @var DateTime
     */
    private $updated;

    /**
     * Временная метка последней активности.
     * @var DateTime
     */
    private $lastactivity;

    /**
     * Хэш пароля.
     * @var string
     */
    private $hpasswd;
}