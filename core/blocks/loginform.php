<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл loginform - форма авторизации
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created  27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// Создаем Форму.
$form = new WChat\Form("loginuser", "/?action=login");
// Добавляем заголовок.
$form->appendHeader(array(
    "type" => "header", 
    "text" => "Вход"
    ));
// Добюавляем поле "Эмейл".
$form->appendInput(array(
    "type" => "email",
    "id" => "email",    
    "label" => "Email",
    "required" => true,
    "description" => "Введите свой email."
));
// Добавляем поле "Пароль".
$form->appendInput(array(
    "type" => "password",
    "id" => "password",    
    "label" => "Пароль",
    "required" => true,
    "description" => "Введите свой пароль (мин. 8 симв.)."
));
// Добавляем кнопку.
$form->appendInput(array(
    "type" => "button",
    "id" => "loginBtn",    
    "text" => "Войти"
));
// Отображаем форму.
echo '<div id="loginform">' . $form->generateForm($context["errors"]) . '</div>';

