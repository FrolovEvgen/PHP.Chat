<?php
// Пространство имен.
namespace WChat;

// Попытка прочитать напрямую отправит в корень.
use mysqli_result;

if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------

/**
 * Класс <b>UserList</b> -- список пользователей.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:20
 * @project PHP.Chat
 */
class UserList
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------


    /**
     * Получить пользователя по ИД.
     *
     * @param int $id ИД пользователя.
     * @return User Найденый пользователь или null.
     */
    public function getUserById(int $id): User {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `id` = $id;");
        $userList = $this->parseUserList($result);
        return count($userList) > 0 ? $userList[0] : null;
    }
    
    /**
     * Получить пользователя по EMail.
     *
     * @param $email string EMail пользователя.
     * @return User|null Найденый пользователь или null.
     */
    public function authUser(string $email, string $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password';");
        $userList = $this->parseUserList($result);
        return count($userList) > 0 ? $userList[0] : null;
    }

    /**
     * Получить всех пользователей.
     * @return array
     */
    public function getUsers(): array {
        $result = Engine::$DB->execQuery("SELECT * FROM `users` WHERE 1;");
        return $this->parseUserList($result);
    }

    /**
     * Поиск пользователей по имени.
     * @param string $search Шаблон имени.
     * @return array Найденные пользователи.
     */
    public function search(string $search): array {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `username` LIKE '%$search%';");
        return $this->parseUserList($result);
    }
    

    /**
     * Добавить пользователя.
     * @param string $username  Имя пользователя.
     * @param string $email ЕМейл пользователя.
     * @param string $password  Пароль пользователя.
     * @param string $phone Телефон пользователя.
     * @return bool|mysqli_result Результат операции.
     */
    public function addUser(string $username, string $email, 
            string $password, string $phone) { 
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`id`, `username`, `email`, `password`, "
                . "`phone`, `icon`, `created`, `updated`) VALUES (NULL, "
                . "'$username', '$email', '$password', '$phone', 'user1.jpg', "
                . "UNIX_TIMESTAMP(), UNIX_TIMESTAMP());";
        return Engine::$DB->execQuery(trim($query));
    }

    /**
     * Проверить есть ли email в базе.
     * @param string $email ЕМейл пользователя.
     * @return bool Результат проверки.
     */
    public function checkEmail(string $email): bool {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `email` = '$email';");
        $userList = $this->parseUserList($result);
        return (count($userList) > 0);        
    }

    /**
     * Проверить ИД сессии и вернуть пользователя, если есть.
     * @return User|null
     */
    public function checkSid() {
        $sid = Engine::getCurrentSid();
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `sid` = '$sid';");
        $userList = $this->parseUserList($result);
        return (count($userList) > 0 ? $userList[0] : null); 
    }

    /**
     * Проверить ИД клиента и вернуть пользователя если есть.
     * @return User|null
     */
    public function checkCid() {
        // Получить ИД клиента.
        $base64Cid = Engine::COOKIE("cid", "");
        // Если его нет - выходим.
        if ($base64Cid === '') {
            return null;
        }
        // Разбираем ИД Клиента.
        $base64Cid = base64_decode($base64Cid);
        // Получаем ИД пользователя и компоненты ИД сессии.
        list($uid, $cid1, $cid2, $cid3, $cid4, $cid5) = explode('-', $base64Cid);
        // Кидаем запрос в базу
        $query = "SELECT * FROM `users` WHERE "
                . "`cid` = '$cid1-$cid2-$cid3-$cid4-$cid5' AND `id` = $uid;";
        $result = Engine::$DB->execQuery($query);
        // нет данных - выходим.
        if ($result === false) {
            return null;
        }
        // Возвращаем пользователя, если есть.
        $userList = $this->parseUserList($result);
        return (count($userList) > 0 ? $userList[0] : null);
    }

    /**
     * Обновить пользовательскую сессию.
     * @param int $uid ИД пользователя.
     * @return bool|mysqli_result Результат операции.
     */
    public function updateUserSession(int $uid) {
        // Генерируем ИД серверной сессии.
        $sid = Engine::getCurrentSid();
        // Генерируем ИД клиентской сессии
        $cid = Engine::getCurrentCid();
        // Сохранаяем клиентскую сессию.
        setcookie("cid", base64_encode($uid . '-' . $cid), time() + (3600 * 24));
        // Оюновляем данные в БД,
        $query = "UPDATE `users` SET `cid` = '$cid', `sid` = '$sid', "
                . "`last_activity` = UNIX_TIMESTAMP() WHERE `id` = $uid;";
        return Engine::$DB->execQuery(trim($query));
    }

    /**
     * Очистить сессию пользователя.
     * @param int $uid ИД пользователя.
     * @return bool|mysqli_result Результат операции.
     */
    public function clearSession(int $uid) {
        // Чистим Килента от "ушей".
        setcookie("cid", time() - (3600 * 24));
        // Чистим данные сессий в БД.
        $query = "UPDATE `users` SET `cid` = '0', `sid` = '0', "
                . "`last_activity` = UNIX_TIMESTAMP() WHERE `id` = $uid;";
        return Engine::$DB->execQuery(trim($query));
    }

    /**
     * Проверяем есть ли в БД вообще пользователи.
     * @return bool
     */
    public function checkRegistered(): bool {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE 1 LIMIT 1;");
        $userList = $this->parseUserList($result);

        return (count($userList) > 0);
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * Обрабатываем результат в массив пользователей.
     * @param mysqli_result $result Результат выборки.
     * @return array Массив пользователей.
     * @throws \Exception
     */
    private function parseUserList(mysqli_result $result): array {
        // массив пользователей.
        $userList = [];
        // Получаем количество строк.
        $rows = mysqli_num_rows($result);
        // Обрабатываем данные.
        for ($i = 0; $i < $rows; $i++) {
            $userData = mysqli_fetch_assoc($result);
            array_push($userList, $this->convertToUser($userData));
        }
        // Возвращаем список.
        return $userList;
    }

    /**
     * Создаем объект пользователя из массива данных.
     * @param array $userData Массив данных.
     * @return User Объект Пользователь.
     * @throws \Exception
     */
    private function convertToUser(array $userData): User {
        return (new User((int) $userData["id"]))
                    ->setUsername($userData["username"])
                    ->setIconname($userData["icon"])
                    ->setPhone($userData["phone"])
                    ->setCreated($userData["created"])
                    ->setUpdated($userData["updated"])
                    ->setLastactivity($userData["last_activity"]);
    }
}