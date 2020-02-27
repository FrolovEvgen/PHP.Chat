<?php
namespace WChat;
session_start();
/**
 * Идентификатор сесии.
 */
define('SESSION_ID', session_id());
//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл <b>index</b> -- основной файл приложения.
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------
// Подключаем инициализацию.
include_once('init.php');

$context = array(
  'userRegistered'=>false,  
  'pageName'=>\WChat\Engine::GET("page", $userAuth ? "chatPage" : "loginPage")
);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- Заголовок страницы. -->
        <title>W.Chat</title>

        <!-- Настройки отображения. -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Подключаем стили. -->
        <link type="text/css" rel="stylesheet" href="css/reset.css" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <?php Engine::loadBlock("ShowPage", $context); ?>
        <!-- Модальное окно "Информация о пользователе" -->
        <?php Engine::loadBlock("UserInfo"); ?>
        <!-- Загрузка скриптов -->
        <script src="js/utils/util.js"></script>
        <script src="js/mixins/mixin.core.js"></script>
        <script src="js/components/searchfield.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
<?php
// Закрываем открытое соединение к БД.
Engine::$DB->disconnect();
?>
