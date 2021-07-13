<?php

if (!empty($message) && $cmd[0] == 'set_age') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка']);
        exit();
    }

    $db->setCmd($chatid, '');
    $db->setAge($chatid, $message);
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['рег'], $btn_menu);
    exit();
}
