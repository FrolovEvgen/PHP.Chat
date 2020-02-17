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
     * Инициализация списка.
     */
    public function init() {
        // Псевдозагрузка пользователей.
        $this->addUser(new User("Петя", "user1.jpg", "petya@email.tst", "36456325462"));
        $this->addUser(new User("Вася", "user2.jpg", "vasya@email.tst", "54754785549"));
        $this->addUser(new User("Федя", "user3.jpg", "fedya@email.tst", "06856898658"));
        $this->addUser(new User("Вика", "user4.jpg", "vika80@email.tst", "3553534655"));
        $this->addUser(new User("Настя", "user5.jpg", "nastya12@email.tst", "4564765"));
        $this->addUser(new User("Юля", "user6.jpg", "yulja@email.tst", "567574757574"));
        $this->addUser(new User("Дима", "user7.jpg", "dima@email.tst", "965968958498"));
        $this->addUser(new User("Жорик", "user8.jpg", "zhora@email.tst", "6354635466"));
        $this->addUser(new User("Вадим", "user9.jpg", "vadim@email.tst", "3645635462"));
        $this->addUser(new User("Николай", "user10.jpg", "kolya@email.tst", "6546366"));
        $this->addUser(new User("Evgeniy", "user11.jpg", "evgen@email.tst", "3335355"));
    }

    /**
     * Получить пользователя по ИД.
     *
     * @param $id int ИД пользователя.
     * @return User Найденый пользователь или null.
     */
    public function getUserById($id): User {
        // Перебор списка.
        foreach ($this->userList as $user) {
            // Если ИД совпали - значит наше.
            if($user->getId() == $id) {
                return $user;
            }
        }
        // ничего не нашли.
        return null;
    }

    /**
     * Добавить пользователя.
     *
     * @param $user User Пользователь.
     */
    public function addUser($user) {
        array_push($this->userList, $user);
    }

    /**
     * Получить количество пользователей.
     * @return int количество пользователей.
     */
    public function count(): int {
        return count($this->userList);
    }

    /**
     * Получить всех пользователей.
     * @return array
     */
    public function getUsers(): array {
        return $this->userList;
    }

    /**
     * Поиск пользователей по имени.
     * @param string $search Шаблон имени.
     * @return array Найденные пользователи.
     */
    public function search(string $search): array {
        $found = [];

        // Осуществляем поиск по шаблону.
        foreach ($this->userList as $user) {
            if (Engine::isConsist($user->getUsername(), $search)) {
                array_push($found, $user);
            }
        }

        // Чистим "уши".
        unset($user);

        // возвращаем результат.
        return $found;
    }
    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * Список пользователей.
     * @var array
     */
    private $userList = [];
}