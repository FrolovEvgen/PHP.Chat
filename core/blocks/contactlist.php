<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл contactlist - список контактов для модального окна.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:43
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------
// Получаем список пользователей.
$userList = WChat\Engine::$USER_LIST->getUsers();

// Формируем список.
$component = '';
foreach ($userList as $user) {
    // Если пользователь текущий - пропускаем.
    if ($user->getId() == WChat\Engine::$CURRENT_USER_ID){continue;}

    $component .= '<li><div class="contact">';
    $component .= '<div class="icon">';
    $component .= '<img alt="User Icon" class="photo" src="img/'.  $user->getIconname() . '"></div>';
    $component .= '<div class="info">';
    $component .= '<p class="username">' . $user->getUsername(). '</p>';
    $component .= '</div></div></li>';
}

// Печатаем список.
echo "<ul class=\"contact_list\">$component</ul>";