<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл processaction - обработка различных действий
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
switch($context["action"]) {
    // Обработка данных формы "Вход".
    case ("login"):
        $result = \WChat\Engine::loadBlock("actionLogin");
        break;
    // Обработка выхода.
    case ("logout"):
        $result = \WChat\Engine::loadBlock("actionLogout");
        break;
    // Обработка данных формы "Регистрации".
    case ("register"):
        $result = \WChat\Engine::loadBlock("actionRegister");
        break;
    // Обработка отправки сообщения.
    case ("saveMessage"):
        $result = \WChat\Engine::loadBlock("actionAddMessage", $context);
        break;
}


