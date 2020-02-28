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
     * @param string $sid
     * @return User|null
     */
    public function getUserBySID(string $sid) {
        $sid = hex2bin($sid);
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `sid` = $sid;");
        $userList = $this->parseUserList($result);
        return count($userList) > 0 ? $userList[0] : null;
    }
    
    /**
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $phone
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
    
    public function checkEmail(string $email) {
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE `email` = '$email';");
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