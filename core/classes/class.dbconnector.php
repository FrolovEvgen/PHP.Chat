<?php
// Пространство имен.
namespace WChat;
use Exception;
use mysqli;
use mysqli_result;

// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//    DESCRIPTIONS
//------------------------------------------------------------------------------

/**
 * Класс <b>DBConnector</b> -- соединение с БД.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 17.02.2020 21:09
 * @project PHP.Chat
 */
class DBConnector
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------
    /**
     * Открывает соединение с сервером MySQL.
     *
     * @param string $dbName  Имя базы данных.
     * @param string $dbUser Имя пользователя БД.
     * @param string $dbPass Пароль пользователя БД.
     * @param string $dbHost  Ххост БД.
     * @return bool|resource указатель на открытую БД или FALSE.
     */
    public function connect(string $dbName, string $dbUser,
                            string $dbPass, string $dbHost){
        try{
            // Соединяемся с БД.
            $this->dbh = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            // Если нет ошибок.
            if(!$this->hasErrors()){
                // Установить кодировку UTF-8.
                mysqli_query($this->dbh, 'SET NAMES utf8');
                mysqli_set_charset($this->dbh,'utf8');

                 return(TRUE);
            }
        }catch(Exception $err){
            echo $err;
        }
        // Сбросить указатель.
        unset($this->_dbh);
        // Выйти
        return(FALSE);
    }

    /**
     * Закрывает соединение с сервером MySQL.>
     * @return boolean результат операции.
     */
    public function disconnect(){
        // Закрыть БД.
        @mysqli_close($this->dbh);
        unset($this->dbh);
        // проверяем на ошибки и выходим
        return (!$this->hasErrors());
    }

    /**
     * Исполнить запрос.
     * @param string $query Запрос.
     * @return bool|mysqli_result   Результат выполнения.
     */
    public function execQuery(string $query) {
        $result = @mysqli_query($this->dbh, trim($query));        
        return $result;
    }

    /**
     * Получить указатель на БД.
     * @return mysqli
     */
    function getDbh() {
        return $this->dbh;
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------
    /**
     * Указатель на соединение с MySQL
     * @var mysqli
     */
    private $dbh;

    /**
     * Сохранить внутренние ошибки.
     * @return bool
     */
    private function hasErrors(){
        $strError = '';
        // если есть описание ошибки - то сохраняем его.
        if(mysqli_connect_errno() !== 0) {
            echo " ----1----";
            $strError = 'ERROR ' . mysqli_connect_errno() . ':' .
                mysqli_connect_error();
        }
        // Если описание ошибки есть - то выводим в лог и выходим.
        if ($strError !== ''){
            echo $strError;
            return(TRUE);
        }
        // если ет описания - значит все в порядке.
        return(FALSE);
    }

}