<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionlogout - деавторизация пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  28.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

// Берем текущего пользователя.
$uid = WChat\Engine::$CURRENT_USER_ID;

// очищаем сессию.
WChat\Engine::$USER_LIST->clearSession($uid);

// Обнуляем пользователя.
WChat\Engine::$CURRENT_USER_ID = null;

// Отправляем на страницу Вход.
$result["userRegistered"] = false;
$result["pageName"] = "loginPage";