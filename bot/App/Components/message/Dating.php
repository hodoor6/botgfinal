<?php

if ($message == $json['buttons']['знакомства'] && empty($cmd[0])) {


    $photo_dating_menu = DEFAULT_PHOTO_DATING_MENU;

    $content = array('chat_id' => $chatid, 'photo' => $photo_dating_menu,
        'parse_mode' => 'HTML', 'reply_markup' => $btndating_menu);
    $tg->sendPhoto($content);
    $msg->replyHTML("Этот отдел бота в наполнении
В ближайшее время  вы сможете воспользоваться всеми функциями.",'');
    exit();
}
