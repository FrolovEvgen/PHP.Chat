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
    "text"=>"Reg"
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
    "required" => true,
    "description" => "Create strong password (min 8 chars)." 
));
$form->appendInput(array(
    "type" => "password",
    "id" => "password2",    
    "label" => "Confirm password",
    "required" => true,
    "description" => "Repeat your password." 
));
$form->appendInput(array(
    "type" => "text",
    "id" => "username",    
    "label" => "User name",
    "required" => true 
));
$form->appendInput(array(
    "type" => "text",
    "id" => "userphone",    
    "label" => "User phone"
));
$form->appendInput(array(
    "type" => "button",
    "id" => "Submit",    
    "text" => "Register"
));

echo '<div id="registrationform">'. $form->generateForm(). '</div>';


