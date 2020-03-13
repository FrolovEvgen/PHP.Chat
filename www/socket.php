<?php
namespace WChat;
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
session_start();
/**
 * Идентификатор сесии.
 */
define('SESSION_ID', session_id());
//------------------------------------------------------------------------------
//    ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл <b>index</b> -- основной файл приложения.
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------
// Подключаем инициализацию.
include_once('init.php');

$result;
$action = \WChat\Engine::GET('action');
if ($action !== '') {
    switch($action) {
        default:
            $result = ErrorResult::message("Try to call unconfigured action '$action'!");
        break;
    }
    
} else {
    $result = ErrorResult::message('Action not set!');    
}

// Закрываем открытое соединение к БД.
Engine::$DB->disconnect();
echo (isset($result) ? $result->serialize() : '{}');



