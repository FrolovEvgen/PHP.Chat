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
     * База данных.
     * @var DBConnector
     */
    public static $DB;

    /**
     * ИД текущего пользователя.
     * @var int
     */
    public static $CURRENT_USER_ID;

    /**
     * ИД выбраного пользователя.
     * @var int
     */
    public static $SELECTED_USER_ID;

    /**
     * Инициализация движка.
     */
    public static function init() {
        // Загружаем связанные классы.
        self::loadClass('AbstractResult');
        self::loadClass('ErrorResult');
        self::loadClass('DBConnector');
        self::loadClass('User');
        self::loadClass('UserList');
        self::loadClass('Message');
        self::loadClass('MessageList');
        self::loadClass('Form');

        // Инициируем список пользователей.
        self::$USER_LIST = new UserList();

        // Инициируем список сообщений.
        self::$MESSAGE_LIST = new MessageList();

        // Создаем коннектор к БД.
        self::$DB = new DBConnector();

        // Устанавливаем текущего пользователя.
        self::$CURRENT_USER_ID = null;

        // Получаем пользователя с кем ведем переписку, если есть.
        self::$SELECTED_USER_ID = self::GET("user_id");

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
     * @param array $context
     * @return mixed Результат операции.
     */
    public static function loadBlock(string $blockName, $context = null) {
        // Имя блока в нижний регистр.
        $blockFile = ROOT . DS . ENGINE . DS . BLOCKS . DS;
        $blockFile .= strtolower($blockName);
        $blockFile .= ".php";

        $result = null;
        
        if (file_exists($blockFile)){
            // Загрузить блок.
            include($blockFile);
        } else {
            echo '<p style="color:maroon;font-weight:bold;">Failed load "' . 
                    $blockName . '" block!</p>';
        }
        return ($result);
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
    public static function GET($strKey, $defaultValue = ''): string {
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
     * $_POST
     *
     * @param string $strKey Параметр массива $_POST.
     * @param string $defaultValue (по-умолчанию = "") Значение по-умолчанию,
     *      если елемент в массиве $_POST отсутствует.
     * @return string Экранированный элемент массива $_POST.
     */
    public static function POST($strKey, $defaultValue = ''): string {
        // Если есть параметр с таким именем, то экранировать переменную.
        if (isset($_POST[$strKey])) {
            $strResult = self::_protectValue($_POST[$strKey]);
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
     * @return mixed Экранированный элемент массива $_SESSION.
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
     * Получить экранированную переменную из глобального массива
     * $_COOKIE.
     *
     * @param string $strKey Параметр массива $_COOKIE.
     * @param string $defaultValue (по-умолчанию = "") Значение по-умолчанию,
     *      если елемент в массиве $_SESSION  отсутствует
     * @return mixed Экранированный элемент массива $_SESSION.
     */
    public static function COOKIE($strKey, $defaultValue = '') {
        // Если есть параметр с таким именем, то экранировать переменную.
        if (isset($_COOKIE[$strKey])) {
            $strResult = self::_protectValue($_COOKIE[$strKey]);
        } else { // Если нет, установить значение по-умолчанию.
            $strResult = $defaultValue;
        }
        // Вернуть результат и сохранить его в глобальной переменной.
        return($strResult);
    }

    /**
     * Проверить Ajax запрос.
     * @return bool результат проверки.
     */
    public static function isAjax(): bool {
        return(self::SESSION('HTTP_X_REQUESTED_WITH')==='XMLHttpRequest');
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

    /**
     * Обработка текстового шаблона.
     * @param string $template Текстовій шаблон.
     * @param array $map Массив Ключь/Значение.
     * @return string Результат.
     */
    public static function parse(string $template, array $map = []) {
        foreach($map as $key=>$val){
            $template = str_replace("@{$key}", $val, $template);
        }
        return $template . '';
    }

    /**
     * Получить ИД клиента.
     * @return string
     */
    public static function getCurrentCid() {
        return self::_asUid(hash('md5', SESSION_ID));
    }

    /**
     * Получить ИД сессии.
     * @return string
     */
    public static function getCurrentSid() {
        return self::_asUid(hash('md4', SESSION_ID));
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
     * Сконвертирвать значение в GUID.
     * @param string $value 32 16ричных символа .
     * @return string GUID
     */
    private static function _asUid(string $value) {
        return preg_replace("/^(.{8})(.{4})(.{4})(.{4})(.{12})$/", 
                "$1-$2-$3-$4-$5", $value);
    }

    /**
     * Список загруженных классов.
     * @var array
     */
    private static $loadedClasses;
}

// Инициализайия движка.
Engine::init();