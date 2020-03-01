<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/?page=error404');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл authuser - отрисовывает страницу соглдасно параметрам.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 26.02.2020 21:53
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<!-- Обертка приложения.  -->
<div id="wchat_app">
    <!-- Заголовок чата. -->
    <header>
        <!-- Логотип. -->
        <div id="logo">
            <img src="img/logo.png" alt="WChat Logo">
        </div>
        <!-- Верхнее меню. -->
        <div id="menu">
            <?php WChat\Engine::loadBlock("TopMenu", $context); ?>
        </div>
    </header>                
    <?php
    // Отрисовываем страницу.
    $pageName = null;
    // Если пользователь зарегистрирован.
    if ($context["userRegistered"]) {
        switch ($context["pageName"]) {
            // Страница чата.
            case ("chatPage"):
                $pageName = "Chat";
                break;
        }
    } else {
        // Если пользователь не зарегистрирован.
        switch ($context["pageName"]) {
            // Страница входа.
            case ("loginPage"):
                $pageName = "LoginForm";
                break;
            //Страница регистрации
            case ("registerPage"):
                $pageName = "RegistrationForm";
                break;
            // Заглушка на страницу чата (чтобы не был умным =))
            case ("chatPage"):
                $pageName = "ErrorPage";
                $context["ContentHeader"] = 'Не выполнен вход!';
                $context["ContentText"] = '<p>Страница которую Вы запрашивали' .
                    ' требует авторизации пользователя. Пожалуйста, перейдите ' .
                    'на <a href="/">Главную страницу</a>.</p>';
                break;
        }
    }

    // Если не отпределили страницу пробуем что-то из общего набора.
    if ($pageName == null) {
        switch ($context["pageName"]) {
            // Страница успешного сообщения.
            case ("success"):
                $pageName = "SuccessPage";
                break;
            // Страница ошибки.
            case ("error"):
                $pageName = "ErrorPage";
                break;
            // страница 404.
            case ("error404"):
                $pageName = "ErrorPage";
                $context["ContentHeader"] = 'Страница не найдена!';
                $context["ContentText"] = '<p>Страница которую Вы запрашивали' .
                    ' отсутствует. Попробуйте изменить запрос или вернуться ' .
                    'на <a href="/">Главную страницу</a>.</p>';
                break;
            default:
                $pageName = "Empty";
                break;
        }
    }
    // Загружаем страницу.
    WChat\Engine::loadBlock($pageName, $context);
    ?>
</div>
<?php
// Если пользователь зарегистрирован - добавим модальные окна.
if ($context["userRegistered"]) {
    // Модальное окно "Информация о Пользователе"
    WChat\Engine::loadBlock("UserInfo");
    // Модальное окно "Контакты".
    WChat\Engine::loadBlock("ModalContacts");
}
?>
<script src="js/script.js"></script>

