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
                    <div id="search"> </div>
                    <!-- Список контактов. -->
                    <?php Engine::loadBlock("LeftContactList"); ?>
                </div>
                <!-- Компонент Чат -->
                <div id="chat">
                    <!-- Панель сообщений в чате. -->
                    <?php Engine::loadBlock("MessageList"); ?>
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
                    <?php Engine::loadBlock("ContactList"); ?>
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
