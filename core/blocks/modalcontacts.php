<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл modalcontacts - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<!-- Модальное окно "Контакты" -->
<div id="contacts_modal" class="modal">
    <div class="cover">
        <!-- Заголовок окна -->
        <div class="modal_header">
            <button class="squarebutton iconbutton cancel">&nbsp;</button>
        </div>
        <!-- Содержимое окна -->
        <div class="modal_content">
            <h3>Контакты</h3>
            <!-- Список контактов. -->
            <?php \WChat\Engine::loadBlock("ContactList"); ?>
        </div>
    </div>
</div>