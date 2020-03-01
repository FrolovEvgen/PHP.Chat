<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл authuser - авторизация пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 26.02.2020 21:53
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// результат операции.
$result = FALSE;
// Получаем пользоватеся по ИД сессии.
$currentUser = WChat\Engine::$USER_LIST->checkSid();
// Если нет пользователя.
if ($currentUser === null) {
    //Получаем пользователя по клиентскому ИД.
    $currentUser = WChat\Engine::$USER_LIST->checkCid();
    // Если пользователь есть - то ОК.
    if ($currentUser !== null) {
        $result = TRUE;
    }
} else { // Если пользователь есть - то ОК.
    $result = TRUE;
}

if ($result) { //Если пользователь есть
    // сохраняем пользователя.
    $uid = $currentUser->getId();
    WChat\Engine::$CURRENT_USER_ID = $uid;
    // Обновляем сессию.
    WChat\Engine::$USER_LIST->updateUserSession($uid);
}