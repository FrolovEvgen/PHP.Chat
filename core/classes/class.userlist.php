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
 * Класс <b>UserList</b> -- без описания.
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
     *
     */
    public function init() {
        $this->addUser(new User("Петя","user1.jpg", "О! Привет!"));
        $this->addUser(new User("Вася","user2.jpg", "Дарова братан!!!"));
        $this->addUser(new User("Федя","user3.jpg", "Ты кто такой?!"));
        $this->addUser(new User("Вика","user4.jpg", "Ты где пропал?!"));
        $this->addUser(new User("Настя","user5.jpg", "Все норм! Только приехала.."));
        $this->addUser(new User("Юля","user6.jpg", "Все нормально =)"));
        $this->addUser(new User("Дима","user7.jpg", "Слушай..тут такая тема надо встретится.."));
        $this->addUser(new User("Жорик","user8.jpg", "Приветы!"));
        $this->addUser(new User("Вадим","user9.jpg", ";)"));
        $this->addUser(new User("Николай","user10.jpg", "Неть меня ))))))))"));
    }

    /**
     * @param $id int
     * @return User
     */
    public function getUserById($id): User {
        foreach ($this->userList as $user) {
            if($user->getId() == $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param $user User
     */
    public function addUser($user) {
        array_push($this->userList, $user);
    }

    /**
     * @return int
     */
    public function count(): int {
        return array_count_values($this->userList);
    }

    /**
     * @return array
     */
    public function getUsers(): array {
        return $this->userList;
    }
    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    private $userList = [];
}