<?php

if (!empty($message) && $cmd[0] == 'set_age_min_filter') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка возраст минимум']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка возраст минимум']);
        exit();
    }

    $db->setCmd($chatid, 'set_age_max_filter');
    $db->setAgeMinFilter($chatid, $message);
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['фильтр возраст максимум']);

    exit();
}
