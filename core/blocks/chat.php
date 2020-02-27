<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл chat - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<!-- Контент чата (контакт лист + формы). -->            
<div id="content">
    <!-- Компонент контакт лист. -->
    <div id="contact_list">
        <!-- Поиск. -->
        <div id="search"> </div>
        <!-- Список контактов. -->
        <?php WChat\Engine::loadBlock("LeftContactList"); ?>
    </div>
    <!-- Компонент Чат -->
    <div id="chat">
        <!-- Панель сообщений в чате. -->
        <?php WChat\Engine::loadBlock("MessageList"); ?>
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