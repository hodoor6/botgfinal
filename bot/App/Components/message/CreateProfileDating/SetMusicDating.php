<?php

if ($cmddating[0] == 'set_music_dating') {

    if ($cmddating[0] == 'set_music_dating' && !empty($music_id)) {
        $db->setCmd($chatid, '', 'dating_users');
        $db->setMusicProfile($chatid, $music_id, 'dating_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $db->setRegStatus($chatid, 0);
        $msg->replyHTML($json['text']['рег'], $dating_menu_btn);
        exit();
    } else {
        $msg->replyHTML($json['text-dating']['загрузите любимый трэк ошибка']);
        exit();
    }
}
