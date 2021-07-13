<?php

if (!empty($message) && $cmd[0] == 'set_age_max_filter') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    $db->setCmd($chatid, '');
    $db->setAgeMaxFilter($chatid, $message);
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['рег фильтр'], $btn_menu);
    exit();
}
