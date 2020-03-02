<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл actionlogin - авторизация пользователя.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  28.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// Контейнер ошибок.
$errors = array();
// Получаем эмейл пользователя.
$email = \WChat\Engine::POST("email");
// Получаем пароль пользователя.
$password = \WChat\Engine::POST("password");
// Проверка эмейла на корректность.
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "E-mail адрес указан неверно.";
    // Есть ли такой эмейл в базе.
} elseIf (!WChat\Engine::$USER_LIST->checkEmail($email)) { 
    $errors["email"] = "E-mail не найден.";
}
// Проверка пароля пользователя.
if (empty($password) || !is_string($password)) {
    $errors["password"] = "Пароль не является строкой или не заполнен.";
    // Проверка "надежности" пароля.
} elseif (strlen($password) < 8) {
    $errors["password"] = "Пароль должен быть минимум 8 символов.";
}
$result = array();
// Если есть ошибки - отправляем обратно.
if (count($errors) !== 0) {
    $result["userRegistered"] = false;
    $result["pageName"] = "loginPage";
    $result["errors"] = $errors;
} else {
    // Авторизируем пользователя.
    $foundUser = WChat\Engine::$USER_LIST->authUser($email);
    // Если нет пользователя, то ошибка.
    if ($foundUser === null) {
        $result["userRegistered"] = false;
        $result["pageName"] = "error";
        // Проверяем ошибки БД.
        $queryResult = mysqli_error_list(WChat\Engine::$DB->getDbh());
        if (count($queryResult) > 0) {
            // Если есть то обрабатываем.
            $result["ContentHeader"] = "MYSQL Ошибки!";
            $result["ContentText"] = "";
            foreach($queryResult as $err) {
                $result["ContentText"] .= "<hr>";
                $result["ContentText"] .= "<p>MySQL Error:" . $err["errno"] . "</p>";
                $result["ContentText"] .= "<p>" . $err["error"] . "</p>";
            }
        }

    } elseif ($foundUser->isPassValid($password)) {
        // Сохраняем пользователя и обновляем сессию.
        $uid = $foundUser->getId();
        WChat\Engine::$USER_LIST->updateUserSession($uid);
        WChat\Engine::$CURRENT_USER_ID = $uid;
        // Направляем на страницу чата.
        $result["userRegistered"] = true;
        $result["pageName"] = "chatPage";
    } else { // Если пароль не верен
        $result["userRegistered"] = false;
        $result["pageName"] = "error";
        $result["ContentHeader"] = "Ошибка авторизации!";
        $result["ContentText"] = "<p>Вы ввели неправильный пароль, для пользователя '$email'!</p>";
        $result["ContentText"] .= "<p>Попробуйте заново: <a href=\"/?page=loginPage\">Войти</a>.</p>";
    }

}