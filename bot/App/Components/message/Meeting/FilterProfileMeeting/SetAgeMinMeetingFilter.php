<?php

if (!empty($message) && $cmddating[0] == 'set_age_min_meeting_filter') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка возраст минимум']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка возраст минимум']);
        exit();
    }

    $db->setCmd($chatid, 'set_age_max_meeting_filter','dating_users');
    $db->setAgeMinFilter($chatid, $message,'meeting_users');
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['фильтр возраст максимум']);

    exit();
}

