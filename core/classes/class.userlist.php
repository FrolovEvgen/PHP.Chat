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
     * @param $id int ИД пользователя.
     * @return User Найденый пользователь или null.
     */
    public function getUserById($id): User {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `id` = $id;");
        $userList = $this->parseUserList($result);
        return count($userList) > 0 ? $userList[0] : null;
    }
    
    /**
     * Получить пользователя по EMail.
     *
     * @param $email string EMail пользователя.
     * @return User Найденый пользователь или null.
     */
    public function authUser(string $email, string $password): User {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `email` = '$email';");
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
        $base64Cid = Engine::COOKIE("cid", "");
        
        if ($base64Cid === '') {
            return null;
        }
        $base64Cid = base64_decode($base64Cid);
        list($uid, $cid1, $cid2, $cid3, $cid4, $cid5) = explode('-', $base64Cid);
        
        $query = "SELECT * FROM `users` WHERE "
                . "`cid` = '$cid1-$cid2-$cid3-$cid4-$cid5' AND `id` = $uid;";

        $result = Engine::$DB->execQuery($query);
        
        if ($result === false) {
            return null;
        }
        
        $userList = $this->parseUserList($result);
        return (count($userList) > 0 ? $userList[0] : null);
    }

    /**
     * Обновить пользовательскую сессию.
     * @param $uid
     * @return bool|mysqli_result
     */
    public function updateUserSession($uid) {
        $sid = Engine::getCurrentSid();
        $cid = Engine::getCurrentCid();
        
        setcookie("cid", base64_encode($uid . '-' . $cid), time() + (3600 * 24));
        
        $query = "UPDATE `users` SET `cid` = '$cid', `sid` = '$sid', "
                . "`last_activity` = UNIX_TIMESTAMP() WHERE `id` = $uid;";
        return Engine::$DB->execQuery(trim($query));
    }
    
    public function clearSession($uid) {
        
        setcookie("cid", time()- (3600 * 24));
        
        $query = "UPDATE `users` SET `cid` = '0', `sid` = '0', "
                . "`last_activity` = UNIX_TIMESTAMP() WHERE `id` = $uid;";
        return Engine::$DB->execQuery(trim($query));
    }

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


    private function parseUserList($result): array {
        $userList = [];

        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $userData = mysqli_fetch_assoc($result);
            array_push($userList, $this->convertToUser($userData));
        }

        return $userList;
    }

    private function convertToUser($userData): User {
        return (new User((int) $userData["id"]))
                    ->setUsername($userData["username"])
                    ->setIconname($userData["icon"])
                    ->setPhone($userData["phone"])
                    ->setCreated($userData["created"])
                    ->setUpdated($userData["updated"])
                    ->setLastactivity($userData["last_activity"]);
    }
}