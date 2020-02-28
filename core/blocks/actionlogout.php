<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionlogout - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  28.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

$uid = WChat\Engine::$CURRENT_USER_ID;
WChat\Engine::$USER_LIST->clearSession($uid);
WChat\Engine::$CURRENT_USER_ID = null;
$result["userRegistered"] = false;
$result["pageName"] = "loginPage";