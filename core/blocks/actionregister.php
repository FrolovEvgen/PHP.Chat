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
} elseIf (WChat\Engine::$USER_LIST->checkEmail($email)) { 
    $errors["email"] = "Already registered.";
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
    $queryResult = WChat\Engine::$USER_LIST->addUser($username, $email, $password, $userphone);
    if ($queryResult === false) {
        $queryResult = mysqli_error_list(WChat\Engine::$DB->getDbh());
        $result["userRegistered"] = false;
        $result["pageName"] = "error";
        $result["ContentHeader"] = "Failed!";
        $result["ContentText"] = "";
        foreach($queryResult as $err) {
            $result["ContentText"] .= "<hr>";
            $result["ContentText"] .= "<p>MySQL Error:" . $err["errno"] . "</p>";
            $result["ContentText"] .= "<p>" . $err["error"] . "</p>";
        }        
    } else {
        $result["userRegistered"] = false;
        $result["pageName"] = "success";
        $result["ContentHeader"] = "Registered!";
        $result["ContentText"] = '<p>Please, <a href="/?=loginPage"> Log In</a> '
                . 'with you EMail and password.';    
    }
}