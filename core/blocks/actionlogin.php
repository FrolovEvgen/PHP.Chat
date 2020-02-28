<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionlogin - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  28.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
$errors = array();

$email = \WChat\Engine::POST("email");
$password = \WChat\Engine::POST("password");

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "E-mail адрес указан неверно.";
} elseIf (!WChat\Engine::$USER_LIST->checkEmail($email)) { 
    $errors["email"] = "User not found.";
}

if (empty($password) || !is_string($password)) {
    $errors["password"] = "Not string format or empty.";
} elseif (strlen($password) < 8) {
    $errors["password"] = "Password must be 8 chars at least.";
}

$result = array();
if (count($errors) !== 0) {
    $result["userRegistered"] = false;
    $result["pageName"] = "loginPage";
    $result["errors"] = $errors;
} else {
    $foundUser = WChat\Engine::$USER_LIST->authUser($email, $password);
    if ($foundUser === null) {
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
        $result["ContentHeader"] = "Login!";
        $result["ContentText"] = '<p>Please, <a href="/?=loginPage"> Log In</a> '
                . 'with you EMail and password.';    
    }
}