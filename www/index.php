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
<div id="wchat_app">
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
    <div id="content">
        <div id="contact_list">
            <div id="search">
                <div id="searchfield">
                    <button class="icon clear">X</button>
                    <input class="textfield" type="text" name="text">
                    <button class="icon search">+</button>
                </div>
            </div>
            <ul id="contacts">
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user1.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Peter Parker</p>
                            <p class="lastmessage">Hello!</p>
                        </div>
                        <div class="time">
                            <p>09:10</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact">
                        <div class="icon">
                            <img class="photo" src="img/user2.jpg">
                        </div>
                        <div class="info">
                            <p class="username">Sten Gordon</p>
                            <p class="lastmessage">Hay you!!!</p>
                        </div>
                        <div class="time">
                            <p>23:35</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div id="chat">
            <div id="messages">

            </div>
            <div id="controls">

            </div>
        </div>
    </div>
</div>
</body>
</html>