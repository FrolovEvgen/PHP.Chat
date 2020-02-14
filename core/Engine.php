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
 * Класс <b>Engine</b> -- без описания.
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
     * @var UserList
     */
    public static $USER_LIST;

    /**
     *
     */
    public static function init() {
        self::loadClass('User');
        self::loadClass('UserList');
        self::loadClass('Message');

        self::$USER_LIST = new UserList();
        self::$USER_LIST->init();
    }

    /**
     * @param string $className
     * @return bool
     */
    public static function loadClass(string $className): bool {
        // Имя класса в нижний регистр.
        $className = strtolower($className);
        include_once(ROOT . DS . ENGINE . DS . CLASSES . DS ."class." .
            $className . ".php");
        // Установить флаг, что Класс загружен и выйти.
        self::$loadedClasses[$className] = TRUE;
        return (TRUE);
    }

    public static function loadBlock(string $blockName) {
        // Имя класса в нижний регистр.
        $className = strtolower($blockName);
        include_once(ROOT . DS . ENGINE . DS . BLOCKS . DS . $blockName . ".php");
    }


    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    //
    private static $loadedClasses;
}
Engine::init();