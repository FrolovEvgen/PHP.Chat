<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл topmenu - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
$menuItems = array();

array_push($menuItems, array(
    "href" => "/?page=chatPage",
    "id" => "linkChatPage",
    "registered" => true,
    "caption" => "Chat"
    ));

array_push($menuItems, array(
    "href" => "#",
    "id" => "btnOpenContactList",
    "registered" => true,
    "caption" => "Contacts"
    ));

array_push($menuItems, array(
    "href" => "#",
    "id" => "btnOpenSettings",
    "registered" => true,
    "caption" => "Settings"
    ));

array_push($menuItems, array(
    "href" => "/?action=logout",
    "id" => "linkLogOut",
    "registered" => true,
    "caption" => "Log Out"
    ));

array_push($menuItems, array(
    "href" => "/?page=registerPage",
    "id" => "linkRegisterPage",
    "registered" => false,
    "caption" => "Register User"
    ));

array_push($menuItems, array(
    "href" => "/?page=loginPage",
    "id" => "linkLoginPage",
    "registered" => false,
    "caption" => "Log In"
    ));

$container = '<ul>';

foreach ($menuItems as $item) {
    if ($item["registered"] != $context["userRegistered"]) {
        continue;
    }

    if(stristr($item["id"], $context["pageName"]) !== false) {
        $container .= '<li class="selected">';
    } else {
        $container .= '<li>';
    }
    
    $container .= '<a';
    $container .= ' id="' . $item["id"] . '"';
    $container .= ' href="' . $item["href"] . '"';
    $container .= '>' . $item["caption"] . '</a>';
}
$container .= '</ul>';
echo $container;