<?php

if (!empty($message) && $cmddating[0] == 'set_age_meeting') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка']);
        exit();
    }

    $db->setCmd($chatid, 'set_city_meeting', 'dating_users');
    $db->setAge($chatid, $message,'meeting_users');
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text-meeting']['город для встречи']);
    exit();
}
