<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл registrationform - форма регистрации
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// создаем форму.
$form = new WChat\Form("registernew", "\?action=register");
// Добавляем заголовок.
$form->appendHeader(array(
    "type" => "header", 
    "text"=>"Регистрация"
    ));
// Добавляем поле "Эмейл".
$form->appendInput(array(
    "type" => "email",
    "id" => "email",    
    "label" => "Email",
    "required" => true,
    "description" => "Введите свой эмейл."
));
// Добавляем поле "Пароль".
$form->appendInput(array(
    "type" => "password",
    "id" => "password",    
    "label" => "Пароль",
    "required" => true,
    "description" => "Создайте сложный пароль (мин. 8 симв.)."
));
// Добавляем поле "Повтор пароля".
$form->appendInput(array(
    "type" => "password",
    "id" => "password2",    
    "label" => "Повторите пароль.",
    "required" => true,
    "description" => "Значения паролей должны совпасть."
));
// Добавляем поле "Имя пользователя".
$form->appendInput(array(
    "type" => "text",
    "id" => "username",    
    "label" => "Имя пользователя.",
    "required" => true 
));
// Добавляем поле "Телефон".
$form->appendInput(array(
    "type" => "text",
    "id" => "userphone",    
    "label" => "Телефон пользователя (опц.)"
));
// Добавляем кнопку.
$form->appendInput(array(
    "type" => "button",
    "id" => "Submit",    
    "text" => "Зарегистрировать."
));
// Отрисовываем форму.
echo '<div id="registrationform">'. 
        $form->generateForm($context["errors"]). '</div>';


