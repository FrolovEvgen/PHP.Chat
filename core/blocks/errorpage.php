<?php
// Попытка прочитать напрямую отправит в корень.
if (!defined('SESSION_ID')) {
    header('Refresh: 0; url=/error404.html');
}

//------------------------------------------------------------------------------
//	DESCRIPTIONS
//------------------------------------------------------------------------------
/**
 * Файл errorpage - без описания
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:00
 * @project PHP.Chat
 */
//------------------------------------------------------------------------------
//	IMPLEMENTS
//------------------------------------------------------------------------------
?>
<div id="errorPage">
    <div class="content_header">
        <h2><?=$context["ContentHeader"];?></h2>
    </div>    
    <div class="content_text">
        <?=$context["ContentText"];?>
    </div>
</div>