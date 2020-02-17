<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	ОПИСАНИЕ
//------------------------------------------------------------------------------
/**
 * Файл userinfo - список контактов для модального окна.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 14.02.2020 9:43
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	РЕАЛИЗАЦИЯ
//------------------------------------------------------------------------------
$userId =  WChat\Engine::GET("info_id");
if ($userId != '') {
    // Получаем пользовател.
    $user = WChat\Engine::$USER_LIST->getUserById($userId);

    ?>
    <div id="user_modal" class="modal">
    <div class="cover">
        <!-- Заголовок окна -->
        <div class="modal_header">
            <button class="squarebutton iconbutton cancel">&nbsp;</button>
        </div>
        <!-- Содержимое окна -->
        <div class="modal_content">
            <h3>Пользователь</h3>
            <div class="icon">
                <img alt="User Icon" class="photo" src="img/<?=$user->getIconname();?>">
            </div>
            <p class="text_input">
                <span class="fieldname">ИД пользователя</span>
                <span class="fieldvalue">: <?=$user->getId();?></span>
            </p>
            <p class="text_input">
                <span class="fieldname">Имя пользователя</span>
                <span class="fieldvalue">: <?=$user->getUsername();?></span>
            </p>
            <p class="text_input">
                <span class="fieldname">E-mail</span>
                <span class="fieldvalue">:  <?=$user->getEmail();?></span>
            </p>
            <p class="text_input">
                <span class="fieldname">Телефон</span>
                <span class="fieldvalue">:  <?=$user->getPhone();?></span>
            </p>
        </div>
    </div>
    <?php
} else {
    echo "!";
}
