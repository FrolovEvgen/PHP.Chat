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

namespace WChat;

function updateUserAuthInfo() {
    $quesry = "
    SET @uid = (SELECT `id` FROM `users` WHERE `cid`=@{old_cid} LIMIT 1);
    UPDATE `users` SET `cid`=@{new_cid}, `sid`=@{new_cid} WHERE `id`=@uid LIMIT 1;
    SELECT @uid as id;
    ";
}

$result = FALSE;

$currentSid = Engine::SESSION("UID", null);
if (!$currentSid) {
    $currentCid = Engine::COOKIE("CID", null);
    if ($currentId) {
        $result = TRUE;
    }
} else {
    $result = TRUE;
}