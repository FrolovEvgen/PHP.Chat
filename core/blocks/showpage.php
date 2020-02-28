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
                $context["ContentHeader"] = 'Page not found!';
                $context["ContentText"] = '<p>The page you’re looking for can’t'
                        . ' be found. Try to change search query or return to '
                        . ' the <a href="/">home page.</a>.</p>';
                break;
            default:  
                $pageName = "Empty"; 
                break;
        }        
        WChat\Engine::loadBlock($pageName, $context);
    ?>
</div>