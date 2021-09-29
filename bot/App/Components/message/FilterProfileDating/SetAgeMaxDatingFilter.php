<?php

if (!empty($message) && $cmddating[0] == 'set_age_max_dating_filter') {
    if (!is_numeric($message)) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    if ($message < 8 || $message > 100) {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);
        exit();
    }

    $db->setCmd($chatid, 'set_goal_communication_dating_filter','dating_users');
    $db->setAgeMaxFilter($chatid, $message,'dating_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['цель общения'], $goal_communication_btn_dating);
    exit();

}
