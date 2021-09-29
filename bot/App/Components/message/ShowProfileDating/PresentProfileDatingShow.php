<?php

if ($data[0] == 'present') {
    if ($db->getPresent($data[1]) !== '') {

        $present = $db->getPresent($data[1]);
        $present = mb_strtolower($present);
        $present_profile_dating = $bt->inlineButtons([
            [
                $json['inline-dating']['подарок ' . $present] => '/',
            ]
        ]);
        $msg->replyHTML($json['text-dating']['подарок выбранный подарок описание'], $present_profile_dating);

        $msg->replyHTML("Этот раздел в стадии разработки и пока недоступен.", $keyb_cancel_back_main_menu_btn_dating);
        clearCache($mem, $chatid);
        exit();
    } else {

        $msg->replyHTML($json['text-dating']['подарок нет подарка описание'], $keyb_cancel_back_main_menu_btn_dating);
        clearCache($mem, $chatid);
        exit();
    }
}