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
 * Класс <b>Engine</b> -- Движок приложения.
 * <br>
 * Управление загрузками классов, блоков, а также фильтрация входящих запросов.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 0:35
 * @project PHP.Chat
 */
class Engine
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------

    /**
     * Список пользователей.
     * @var UserList
     */
    public static $USER_LIST;

    /**
     * Список сообщений.
     * @var MessageList
     */
    public static $MESSAGE_LIST;

    /**
     * ИД текущего пользователя.
     * @var int
     */
    public static $CURRENT_USER_ID;

    /**
     * Инициализация движка.
     */
    public static function init() {
        // Загружаем связанные классы.
        self::loadClass('User');
        self::loadClass('UserList');
        self::loadClass('Message');
        self::loadClass('MessageList');

        // Инициируем список пользователей.
        self::$USER_LIST = new UserList();
        self::$USER_LIST->init();

        // Устанавливаем текущего пользователя.
        self::$CURRENT_USER_ID = 11;

        // Инициируем список сообщений.
        self::$MESSAGE_LIST = new MessageList();
        self::$MESSAGE_LIST->init();
    }

    /**
     * Загрузить класс по имени.
     *
     * @param string $className Имя класса.
     * @return bool Результат операции.
     */
    public static function loadClass(string $className): bool {
        // Имя класса в нижний регистр.
        $className = strtolower($className);

        // Подключить класс.
        include_once(ROOT . DS . ENGINE . DS . CLASSES . DS ."class." .
            $className . ".php");

        // Установить флаг, что Класс загружен и выйти.
        self::$loadedClasses[$className] = TRUE;

        return (TRUE);
    }

    /**
     * Загрузить блок по имени.
     *
     * @param string $blockName Имя блока.
     * @return bool Результат операции.
     */
    public static function loadBlock(string $blockName): bool {
        // Имя блока в нижний регистр.
        $blockName = strtolower($blockName);

        // Загрузить блок.
        include(ROOT . DS . ENGINE . DS . BLOCKS . DS . $blockName . ".php");

        return (TRUE);
    }


    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * Список загруженных классов.
     * @var array
     */
    private static $loadedClasses;
}

// Инициализайия движка.
Engine::init();