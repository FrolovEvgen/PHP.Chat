<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл contactlist - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:43
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
$userList = WChat\Engine::$USER_LIST->getUsers();
$component = '';
foreach ($userList as $user) {
    $component .= '<li><div class="contact">';
    $component .= '<div class="icon">';
    $component .= '<img alt="User Icon" class="photo" src="img/'.  $user->getIconname() . '"></div>';
    $component .= '<div class="info">';
    $component .= '<p class="username">' . $user->getUsername(). '</p>';
    $component .= '</div></div></li>';
}
echo "<ul class=\"contact_list\">$component</ul>";

