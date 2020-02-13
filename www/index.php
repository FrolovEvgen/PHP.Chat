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
        <!-- Обертка приложения.  -->
        <div id="wchat_app">
            <!-- Заголовок чата. -->
            <header>
                <!-- Логотип. -->
                <div id="logo">
                    <img src="img/logo.png" alt="WChat Logo">
                </div>
                <!-- Верхнее меню. -->
                <div id="menu">
                    <ul>
                        <li>
                            <a hef="#" id="btn_opencontact">Контакты</a>
                        </li>
                        <li>
                            <a hef="#">Настройки</a>
                        </li>
                        <li>
                            <a hef="#" id="btn_openlogin">Войти</a>
                        </li>
                    </ul>
                </div>
            </header>
            <!-- Контент чата (контакт лист + формы). -->
            <div id="content">
                <!-- Компонент контакт лист. -->
                <div id="contact_list">
                    <!-- Полу поиска. -->
                    <div id="search">
                        <div id="searchfield" class="textinput">
                            <button class="squarebutton iconbutton cancel hidden">&nbsp;</button>
                            <input class="textfield" type="text" name="text">
                            <button class="squarebutton iconbutton search">&nbsp;</button>
                        </div>
                    </div>
                    <!-- Список контактов. -->
                    <ul class="contact_list">
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
                <!-- Компонент Чат -->
                <div id="chat">
                    <!-- Панель сообщений в чате. -->
                    <div id="messages">
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user1.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Peter Parker</p>
                                <p class="currentmessage">Blue – Responsive Vertical Dashboard Navigation is an admin dashboard menu, completely designed via Bootstrap, clean and valid HTML5 and CSS3 codes. Menu includes HTML, CSS, JS files also texts are formatted using Google Font and FontAwesome icons. Dashboard is fully responsive and it includes off canvas menu. Its also compatible with all browsers: Chrome, Mozilla, Opera, Safari, Edge, IE8, IE9, IE10, IE11. We definitely recommend you to buy our product if you desire elegant and modern dashboard menu in your website.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user2.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Sten Gordon</p>
                                <p class="currentmessage">Using the library PDF.js, Wowbook can render PDF files with support for internal links, external html links, index and selectable text.</p>
                                <p class="currentmessage">BETA: PDF SEARCH</p>
                                <p class="currentmessage">WARNING: PDF rendering does not work on IE9 because the library PDF.js it’s not working on IE9</p>
                                <p class="currentmessage">Responsive:</p>
                                <p class="currentmessage">Comes with built in features to resize the book to adapt for different screens dimensions. Touch support (with pinch to zoom and double click to zoom). Responsive toolbar.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user1.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Peter Parker</p>
                                <p class="currentmessage">Blue – Responsive Vertical Dashboard Navigation is an admin dashboard menu, completely designed via Bootstrap, clean and valid HTML5 and CSS3 codes. Menu includes HTML, CSS, JS files also texts are formatted using Google Font and FontAwesome icons. Dashboard is fully responsive and it includes off canvas menu. Its also compatible with all browsers: Chrome, Mozilla, Opera, Safari, Edge, IE8, IE9, IE10, IE11. We definitely recommend you to buy our product if you desire elegant and modern dashboard menu in your website.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user2.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Sten Gordon</p>
                                <p class="currentmessage">Using the library PDF.js, Wowbook can render PDF files with support for internal links, external html links, index and selectable text.</p>
                                <p class="currentmessage">BETA: PDF SEARCH</p>
                                <p class="currentmessage">WARNING: PDF rendering does not work on IE9 because the library PDF.js it’s not working on IE9</p>
                                <p class="currentmessage">Responsive:</p>
                                <p class="currentmessage">Comes with built in features to resize the book to adapt for different screens dimensions. Touch support (with pinch to zoom and double click to zoom). Responsive toolbar.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user1.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Peter Parker</p>
                                <p class="currentmessage">Blue – Responsive Vertical Dashboard Navigation is an admin dashboard menu, completely designed via Bootstrap, clean and valid HTML5 and CSS3 codes. Menu includes HTML, CSS, JS files also texts are formatted using Google Font and FontAwesome icons. Dashboard is fully responsive and it includes off canvas menu. Its also compatible with all browsers: Chrome, Mozilla, Opera, Safari, Edge, IE8, IE9, IE10, IE11. We definitely recommend you to buy our product if you desire elegant and modern dashboard menu in your website.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user2.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Sten Gordon</p>
                                <p class="currentmessage">Using the library PDF.js, Wowbook can render PDF files with support for internal links, external html links, index and selectable text.</p>
                                <p class="currentmessage">BETA: PDF SEARCH</p>
                                <p class="currentmessage">WARNING: PDF rendering does not work on IE9 because the library PDF.js it’s not working on IE9</p>
                                <p class="currentmessage">Responsive:</p>
                                <p class="currentmessage">Comes with built in features to resize the book to adapt for different screens dimensions. Touch support (with pinch to zoom and double click to zoom). Responsive toolbar.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user1.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Peter Parker</p>
                                <p class="currentmessage">Blue – Responsive Vertical Dashboard Navigation is an admin dashboard menu, completely designed via Bootstrap, clean and valid HTML5 and CSS3 codes. Menu includes HTML, CSS, JS files also texts are formatted using Google Font and FontAwesome icons. Dashboard is fully responsive and it includes off canvas menu. Its also compatible with all browsers: Chrome, Mozilla, Opera, Safari, Edge, IE8, IE9, IE10, IE11. We definitely recommend you to buy our product if you desire elegant and modern dashboard menu in your website.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user2.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Sten Gordon</p>
                                <p class="currentmessage">Using the library PDF.js, Wowbook can render PDF files with support for internal links, external html links, index and selectable text.</p>
                                <p class="currentmessage">BETA: PDF SEARCH</p>
                                <p class="currentmessage">WARNING: PDF rendering does not work on IE9 because the library PDF.js it’s not working on IE9</p>
                                <p class="currentmessage">Responsive:</p>
                                <p class="currentmessage">Comes with built in features to resize the book to adapt for different screens dimensions. Touch support (with pinch to zoom and double click to zoom). Responsive toolbar.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user1.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Peter Parker</p>
                                <p class="currentmessage">Blue – Responsive Vertical Dashboard Navigation is an admin dashboard menu, completely designed via Bootstrap, clean and valid HTML5 and CSS3 codes. Menu includes HTML, CSS, JS files also texts are formatted using Google Font and FontAwesome icons. Dashboard is fully responsive and it includes off canvas menu. Its also compatible with all browsers: Chrome, Mozilla, Opera, Safari, Edge, IE8, IE9, IE10, IE11. We definitely recommend you to buy our product if you desire elegant and modern dashboard menu in your website.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="icon">
                                <img class="photo" src="img/user2.jpg">
                            </div>
                            <div class="info">
                                <p class="username">Sten Gordon</p>
                                <p class="currentmessage">Using the library PDF.js, Wowbook can render PDF files with support for internal links, external html links, index and selectable text.</p>
                                <p class="currentmessage">BETA: PDF SEARCH</p>
                                <p class="currentmessage">WARNING: PDF rendering does not work on IE9 because the library PDF.js it’s not working on IE9</p>
                                <p class="currentmessage">Responsive:</p>
                                <p class="currentmessage">Comes with built in features to resize the book to adapt for different screens dimensions. Touch support (with pinch to zoom and double click to zoom). Responsive toolbar.</p>
                            </div>
                            <div class="time">
                                <p>09:10</p>
                            </div>
                        </div>
                    </div>
                    <!-- Панель оправки сообщения в чат. -->
                    <div id="controls">
                        <!-- Панель ввода сообщения. -->
                        <div id="fields" class="textinput">
                            <button class="squarebutton iconbutton cancel hidden">&nbsp;</button>
                            <input type="text" name="newmessage" class="textfield">
                            <button class="squarebutton iconbutton send">&nbsp;</button>
                        </div>
                        <!-- Панель форматирования. -->
                        <div id="format">
                            <!-- Форматирование цвета. -->
                            <div id="colorformat">
                                <button class="squarebutton colorbutton black selected"></button>
                                <button class="squarebutton colorbutton red"></button>
                                <button class="squarebutton colorbutton green"></button>
                                <button class="squarebutton colorbutton blue"></button>
                            </div>
                            <!-- Форматирование текста -->
                            <div id="textformat">
                                <button class="squarebutton iconbutton bold">&nbsp;</button>
                                <button class="squarebutton iconbutton italic">&nbsp;</button>
                                <button class="squarebutton iconbutton underline">&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Модальное окно "Контакты" -->
        <div id="contacts_modal" class="modal">
            <div class="cover">
                <!-- Заголовок окна -->
                <div class="modal_header">
                    <button class="squarebutton iconbutton cancel">&nbsp;</button>
                </div>
                <!-- Содержимое окна -->
                <div class="modal_content">
                    <h3>Контакты</h3>
                    <!-- Список контактов. -->
                    <ul class="contact_list">
                        <li>
                            <div class="contact">
                                <div class="icon">
                                    <img class="photo" src="img/user1.jpg">
                                </div>
                                <div class="info">
                                    <p class="username">Peter Parker</p>
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
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Модальное окно "Вход" -->
        <div id="login_modal" class="modal">
            <div class="cover">
                <!-- Заголовок окна -->
                <div class="modal_header">
                    <button class="squarebutton iconbutton cancel">&nbsp;</button>
                </div>
                <!-- Содержимое окна -->
                <div class="modal_content">
                    <h3>Вход</h3>
                    <!-- Поле логина -->
                    <div class="labeled_input">
                        <label for="username">E-MAil</label>
                        <input id="username" name="username" type="text" placeholder="логин">
                    </div>
                    <!-- Поле пароля -->
                    <div class="labeled_input">
                        <label for="password">Пароль</label>
                        <input id="password" name="password" type="password" placeholder="пароль">
                    </div>
                    <button class="textbutton">Войти</button>
                </div>
            </div>
        </div>

        <!-- Загрузка скриптов -->
        <script src="js/script.js"></script>
    </body>
</html>