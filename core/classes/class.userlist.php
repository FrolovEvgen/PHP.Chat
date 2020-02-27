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
            "SELECT * FROM `users` WHERE id=$id;");
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
            "SELECT * FROM `users` WHERE username LIKE '%$search%';");
        return $this->parseUserList($result);
    }

    /**
     * @param string $sid
     * @return User|null
     */
    public function getUserBySID(string $sid) {
        $sid = hex2bin($sid);
        $result = Engine::$DB->execQuery(
            "SELECT * FROM `users` WHERE sid=$sid;");
        $userList = $this->parseUserList($result);
        return count($userList) > 0 ? $userList[0] : null;
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