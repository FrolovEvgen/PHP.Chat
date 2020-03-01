<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionaddmessage - Сохранить сообщение пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 01.03.2020 21:48
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

// Получить свой ИД.
$currentUserId = WChat\Engine::$CURRENT_USER_ID;

// ИД получателя.
$selectedUserId = WChat\Engine::$SELECTED_USER_ID;

// Сообщение.
$message = trim($context["message"]);

// Добавляем в базу.
WChat\Engine::$MESSAGE_LIST->addMessage($currentUserId, $selectedUserId, $message);

// Перенаправляем на страницу чата.
$result["userRegistered"] = true;
$result["pageName"] = "chatPage";