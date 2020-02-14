<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл contactlist - создает список контактов для модального окна.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:43
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------

// Получаем сообщения с пользователем по его ИД.
$messageList = WChat\Engine::$MESSAGE_LIST->getMessages(1);

// Добавляем сообщения.
$component = '';
foreach ($messageList as $message) {
    // Получаем инфу о пользователе по ИД.
    $user = WChat\Engine::$USER_LIST->getUserById($message->getUserId());

    $component .= '<div class="message" data-id="' . $user->getId() . '">';
    $component .= '<div class="icon">';
    $component .= '<img alt="User Icon" class="photo" src="img/'.  $user->getIconname() . '">';
    $component .= '</div><div class="info">';
    $component .= '<p class="username">' . $user->getUsername(). '</p>';
    $component .= '<p class="currentmessage">' . $message->getMessage() . '</p>';
    $component .= '</div><div class="time">';
    $component .= '<p>' . $message->getTime() . '</p>';
    $component .= '</div></div>';
}

// Печатаем результат.
echo "<div id=\"messages\">$component</div>";
