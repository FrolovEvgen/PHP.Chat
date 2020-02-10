<?php
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
        <div id="chat">
            <header>
                <div id="logo">
                    <img src="img/logo.png" alt="WChat Logo">
                </div>
                <div id="menu">
                    <ul>
                        <li>
                            <a hef="#">Контакты</a>
                        </li>
                        <li>
                            <a hef="#">Настройки</a>
                        </li>
                        <li>
                            <a hef="#">Войти</a>
                        </li>
                    </ul>
                </div>
            </header>
        </div>
    </body>
</html>