<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл authuser - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 26.02.2020 21:53
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

$result = FALSE;

$currentUser = WChat\Engine::$USER_LIST->checkSid();
if ($currentUser === null) {
    $currentUser = WChat\Engine::$USER_LIST->checkCid();
    if ($currentUser !== null) {
        $result = TRUE;
    }
} else {
    $result = TRUE;
}

if ($result) {
    $uid = $currentUser->getId();
    WChat\Engine::$USER_LIST->updateUserSession($uid);
    WChat\Engine::$CURRENT_USER_ID = $uid;
}