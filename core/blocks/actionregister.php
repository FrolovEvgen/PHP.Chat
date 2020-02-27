<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionregister - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
$errors = array();

$email = \WChat\Engine::POST("email");
$password = \WChat\Engine::POST("password");
$password2 = \WChat\Engine::POST("password2");
$username = \WChat\Engine::POST("username");
$userphone = \WChat\Engine::POST("userphone", 'No number');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "E-mail адрес указан неверно.";
}

if (empty($password) || !is_string($password)) {
    $errors["password"] = "Not string format or empty.";
} elseif (strlen($password) < 8) {
    $errors["password"] = "Password must be 8 chars at least.";
}


if (empty($password2) || !is_string($password2)) {
    $errors["password2"] = "Not string format or empty.";

}

if ($password !== $password2) {
    $errors["password2"] = "Passowrds not match.";
}

if (empty($username) || !is_string($username)) {
    $errors["username"] = "Wrong User Name or empty.";
}

$result = array();
if (count($errors) !== 0) {
    $result["userRegistered"] = false;
    $result["pageName"] = "registerPage";
    $result["errors"] = $errors;
} else {
    $query = "";    
}