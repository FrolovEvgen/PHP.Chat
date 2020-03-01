<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionregister - регистрация пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// Мамссив ошибок.
$errors = array();
// Получаем эмейл.
$email = \WChat\Engine::POST("email");
// Получаем пароль.
$password = \WChat\Engine::POST("password");
// Получаем повтор пароля.
$password2 = \WChat\Engine::POST("password2");
// Получаем имя пользователя.
$username = \WChat\Engine::POST("username");
// Получаем телефон пользователя.
$userphone = \WChat\Engine::POST("userphone", 'No number');
// проверяем эмейл.
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "E-mail адрес указан неверно.";
    // Проверяем зарегистрирован ли уже данный эмейл.
} elseIf (WChat\Engine::$USER_LIST->checkEmail($email)) { 
    $errors["email"] = "Такой E-mail уже есть.";
}
// Проверяем пароль.
if (empty($password) || !is_string($password)) {
    $errors["password"] = "Not string format or empty.";
    // Проверяем "сложность" пароля.
} elseif (strlen($password) < 8) {
    $errors["password"] = "Пароль должен быть минимум 8 символов.";
}
// Проверяем повтор пароля.
if (empty($password2) || !is_string($password2)) {
    $errors["password2"] = "Пароль некорректный или пуст";
    // Проверяем совпадение паролей
} elseif ($password !== $password2) {
    $errors["password2"] = "Пароли должны совпасть..";
}
// Проверяем имя пользователя.
if (empty($username) || !is_string($username)) {
    $errors["username"] = "Неправильное имя пользователя.";
}
$result = array();
// Если есть ошибки - выкидуем страницу с ошибкой.
if (count($errors) !== 0) {
    $result["userRegistered"] = false;
    $result["pageName"] = "registerPage";
    $result["errors"] = $errors;
} else {
    // Создаем пользователя.
    $queryResult = WChat\Engine::$USER_LIST->addUser($username, $email, $password, $userphone);
    // Если не получилось.
    if ($queryResult === false) {
        // Получаем список ошибок и обрабатывааем их для вывода.
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
    } else { // Если все ок, выводим страницу с Поздравлением.
        $result["userRegistered"] = false;
        $result["pageName"] = "success";
        $result["ContentHeader"] = "Зарегистрирован!";
        $result["ContentText"] = '<p>Пожалуйста, <a href="/?=loginPage">Авторизируйтесь</a> '
                . 'с Вашим EMail и паролем.';
    }
}