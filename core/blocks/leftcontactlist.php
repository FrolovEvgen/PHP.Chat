<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл leftcontactlist - Список контактов в левой панели.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:10
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------

// Получаем список пользователей.
$userList = WChat\Engine::$USER_LIST->getUsers();

// перебираем пользователей и заполняем список.
$component = '';
foreach ($userList as $user) {

    // Если пользователь текущий, то пропускаем его.
    if ($user->getId() == WChat\Engine::$CURRENT_USER_ID) {continue;}

    $selected = (WChat\Engine::$SELECTED_USER_ID == $user->getId());

    // Получаем последнее сообщение, если есть.
    $message = WChat\Engine::$MESSAGE_LIST->getLastMessage($user->getId());

    $component .= '<li><div class="contact' . ($selected ? ' selected' : '');
    $component .='" data-id="' . $user->getId() . '" >';
    $component .= '<div class="icon">';
    $component .= '<img alt="User Icon" class="photo" src="img/'.  $user->getIconname() . '"></div>';
    $component .= '<div class="info">';
    $component .= '<p class="username">' . $user->getUsername(). '</p>';
    $component .= '<p class="lastmessage">' . ($message ? $message->getMessage() : '&nbsp') . '</p>';
    $component .= '</div><div class="time">';
    $component .= '<p>' . ($message ? $message->getTime() : '&nbsp'). '</p>';
    $component .= '</div></div></li>';
}

// Печатаем список.
echo "<ul class=\"contact_list\">$component</ul>";