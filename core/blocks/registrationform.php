<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл registrationform - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

$form = new WChat\Form("registernew", "\?action=register");
        
$form->appendHeader(array(
    "type" => "header", 
    "text"=>"Регистрация"
    ));
$form->appendInput(array(
    "type" => "email",
    "id" => "email",    
    "label" => "Email",
    "required" => true,
    "description" => "Введите свой эмейл."
));
$form->appendInput(array(
    "type" => "password",
    "id" => "password",    
    "label" => "Пароль",
    "required" => true,
    "description" => "Создайте сложный пароль (мин. 8 симв.)."
));
$form->appendInput(array(
    "type" => "password",
    "id" => "password2",    
    "label" => "Повторите пароль.",
    "required" => true,
    "description" => "Значения паролей должны совпасть."
));
$form->appendInput(array(
    "type" => "text",
    "id" => "username",    
    "label" => "Имя пользователя.",
    "required" => true 
));
$form->appendInput(array(
    "type" => "text",
    "id" => "userphone",    
    "label" => "Телефон пользователя (опц.)"
));
$form->appendInput(array(
    "type" => "button",
    "id" => "Submit",    
    "text" => "Зарегистрировать."
));

echo '<div id="registrationform">'. 
        $form->generateForm($context["errors"]). '</div>';


