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

    public static $SELECTED_USER_ID;

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

        self::$SELECTED_USER_ID = self::GET("user_id");

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

    /**
     * Получить экранированную переменную из глобального массива
     * $_GET
     *
     * @param string $strKey Параметр массива $_GET.
     * @param string $defaultValue (по-умолчанию = "") Значение по-умолчанию,
     *      если елемент в массиве $_GET отсутствует.
     * @return string Экранированный элемент массива $_GET.
     */
    public static function GET($strKey, $defaultValue = '') {
        // Если есть параметр с таким именем, то экранировать переменную.
        if (isset($_GET[$strKey])) {
            $strResult = self::_protectValue($_GET[$strKey]);
        } else { // Если нет, установить значение по-умолчанию.
            $strResult = $defaultValue;
        }
        // Вернуть результат и сохранить его в глобальной переменной.
        return($strResult);
    }

    /**
     * Получить экранированную переменную из глобального массива
     * $_SESSION.
     *
     * @param string $strKey Параметр массива $_SESSION.
     * @param string $defaultValue (по-умолчанию = "") Значение по-умолчанию,
     *      если елемент в массиве $_SESSION  отсутствует
     * @return string Экранированный элемент массива $_SESSION.
     */
    public static function SESSION($strKey, $defaultValue = '') {
        // Если есть параметр с таким именем, то экранировать переменную.
        if (isset($_SESSION[$strKey])) {
            $strResult = self::_protectValue($_SESSION[$strKey]);
        } else { // Если нет, установить значение по-умолчанию.
            $strResult = $defaultValue;
        }
        // Вернуть результат и сохранить его в глобальной переменной.
        return($strResult);
    }

    /**
     * Поиск вхождения строки в подстроку (включая кириллицу).
     *
     * @param string $haystack Строка, в которой производится поиск.
     * @param string $needle Поисковый текст.
     * @return bool Результат операции.
     */
    public static function isConsist(string $haystack, string $needle): bool {
        // Утраняем глюки с кириллицей.
        $target = iconv('UTF-8','WINDOWS-1251', $haystack);
        $search = iconv('UTF-8','WINDOWS-1251', $needle);

        return (stristr($target,  $search) !== false);
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * Экранирование переменной.
     * Используется для удаления различных несанкционированных данных в
     * передаваемых параметрах.
     *
     * @param mixed $value Неэкранированное значение.
     * @return mixed Экранированное значение.
     */
    private static function _protectValue($value) {
        // Если значение является массивом.
        if (is_array($value)) {
            // Экранировать каждый элемент массива.
            foreach ($value as $key=>$val) {
                $value[$key] = self::_protectValue($val);
            }
        } else if (!is_object ($val)) {// Если значение не массив.
            // "Обрезаем" лишние пробелы.
            $value = trim($value);
            // Экранируем спецсимволы.
            $value = htmlspecialchars($value);
        }
        // Возвращаем экранированное значение.
        return ($value);
    }

    /**
     * Список загруженных классов.
     * @var array
     */
    private static $loadedClasses;
}

// Инициализайия движка.
Engine::init();