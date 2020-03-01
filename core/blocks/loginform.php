<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл loginform - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------

$form = new WChat\Form("loginuser", "/?action=login");

$form->appendHeader(array(
    "type" => "header", 
    "text" => "Вход"
    ));
$form->appendInput(array(
    "type" => "email",
    "id" => "email",    
    "label" => "Email",
    "required" => true,
    "description" => "Введите свой email."
));
$form->appendInput(array(
    "type" => "password",
    "id" => "password",    
    "label" => "Пароль",
    "required" => true,
    "description" => "Введите свой пароль (мин. 8 симв.)."
));
$form->appendInput(array(
    "type" => "button",
    "id" => "loginBtn",    
    "text" => "Войти"
));

echo '<div id="loginform">' . $form->generateForm($context["errors"]) . '</div>';

