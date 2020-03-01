<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл modallogin - модальное окно "Вход".
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<!-- Модальное окно "Вход" -->
<div id="login_modal" class="modal">
    <div class="cover">
        <!-- Заголовок окна -->
        <div class="modal_header">
            <button class="squarebutton iconbutton cancel">&nbsp;</button>
        </div>
        <!-- Содержимое окна -->
        <div class="modal_content">
            <h3>Вход</h3>
            <!-- Поле логина -->
            <div class="labeled_input">
                <label for="username">E-MAil</label>
                <input id="username" name="username" type="text" placeholder="логин">
            </div>
            <!-- Поле пароля -->
            <div class="labeled_input">
                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" placeholder="пароль">
            </div>
            <button class="textbutton">Войти</button>
        </div>
    </div>
</div>