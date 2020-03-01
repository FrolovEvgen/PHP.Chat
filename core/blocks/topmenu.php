<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл topmenu - верхнее меню
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
// Набор элементов Меню.
$menuItems = array();
// Страница чата.
array_push($menuItems, array(
    "href" => "/?page=chatPage",
    "id" => "linkChatPage",
    "registered" => true,
    "caption" => "Чат"
    ));
// Модальное окно Контактов.
array_push($menuItems, array(
    "href" => "#",
    "id" => "btnOpenContactList",
    "registered" => true,
    "caption" => "Контакты"
    ));
// Страница настроек.
array_push($menuItems, array(
    "href" => "#",
    "id" => "btnOpenSettings",
    "registered" => true,
    "caption" => "Настройки"
    ));
// Выход из чата.
array_push($menuItems, array(
    "href" => "/?action=logout",
    "id" => "linkLogOut",
    "registered" => true,
    "caption" => "Выход"
    ));
// Страница регистрации.
array_push($menuItems, array(
    "href" => "/?page=registerPage",
    "id" => "linkRegisterPage",
    "registered" => false,
    "caption" => "Регистрация"
    ));
// Страницавхода.
array_push($menuItems, array(
    "href" => "/?page=loginPage",
    "id" => "linkLoginPage",
    "registered" => false,
    "caption" => "Вход"
    ));

// Отрисовываем меню.
$container = '<ul>';
foreach ($menuItems as $item) {
    // Фильтр статуса пользователя.
    if ($item["registered"] != $context["userRegistered"]) {
        continue;
    }
    // если можем - устанавливаем  подсветку активного пункта меню.
    if(stristr($item["id"], $context["pageName"]) !== false) {
        $container .= '<li class="selected">';
    } else {
        $container .= '<li>';
    }
    // "Рисуем" элемент.
    $container .= '<a';
    $container .= ' id="' . $item["id"] . '"';
    $container .= ' href="' . $item["href"] . '"';
    $container .= '>' . $item["caption"] . '</a>';
}
$container .= '</ul>';
// Выводим меню.
echo $container;