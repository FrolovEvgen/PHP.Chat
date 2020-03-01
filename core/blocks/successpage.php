<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл successpage - страница успешного сообщения.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<!-- Каркас страницы -->
<div id="successPage">
    <!-- Заголовок сообщения. -->
    <div class="content_header">
        <h2><?=$context["ContentHeader"];?></h2>
    </div>
    <!-- Текст сообщения. -->
    <div class="content_text">
        <?=$context["ContentText"];?>
    </div>
</div>
