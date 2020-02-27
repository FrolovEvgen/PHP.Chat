<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл processaction - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
switch($context["action"]) {
    case ("login"):
        $result = \WChat\Engine::loadBlock("actionLogin");
        break;
    case ("logout"):
        $result = \WChat\Engine::loadBlock("actionLogout");
        break;
    case ("register"):
        $result = \WChat\Engine::loadBlock("actionRegister");
        break;            
}


