<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/?page=error404');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл authuser - без описания
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
        $pageName = null;
        switch ($context["pageName"]) {
            case ("loginPage"): 
                $pageName = "LoginForm"; 
                break;
            case ("registerPage"):  
                $pageName = "RegistrationForm"; 
                break;
            case ("chatPage"):  
                $pageName = "Chat"; 
                break;
            case ("success"):
                $pageName = "SuccessPage"; 
                break;
            case ("error"):
                $pageName = "ErrorPage"; 
                break;
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
        WChat\Engine::loadBlock($pageName, $context);
    ?>
</div>
<?php
if ($context["userRegistered"]) {
    WChat\Engine::loadBlock("UserInfo");
    WChat\Engine::loadBlock("ModalContacts");
}
?>
<script src="js/script.js"></script>

