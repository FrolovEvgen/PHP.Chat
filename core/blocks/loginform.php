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
    "text" => "Reg"
    ));
$form->appendInput(array(
    "type" => "email",
    "id" => "email",    
    "label" => "Email",
    "required" => true,
    "description" => "Provide registration email." 
));
$form->appendInput(array(
    "type" => "password",
    "id" => "password",    
    "label" => "Password",
    "required" => true
));
$form->appendInput(array(
    "type" => "button",
    "id" => "loginBtn",    
    "text" => "Log In"
));

echo '<div id="loginform">' . $form->generateForm() . '</div>';

