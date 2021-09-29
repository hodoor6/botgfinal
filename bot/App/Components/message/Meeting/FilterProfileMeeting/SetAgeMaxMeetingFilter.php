<?php

if (!empty($message) && $cmddating[0] == 'set_age_max_meeting_filter') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    $db->setCmd($chatid, 'set_city_meeting_filter','dating_users');
    $db->setAgeMaxFilter($chatid, $message,'meeting_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-meeting']['город для встречи']);
    exit();

}
