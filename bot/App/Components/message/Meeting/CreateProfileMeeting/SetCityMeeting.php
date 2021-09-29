<?php


if ($cmddating[0] == 'set_city_meeting' && !empty($message)) {
    $city = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');

    if ($db->isCity($city)) {
        $db->setCmd($chatid, 'set_goal_communication_meeting', 'dating_users');
        $db->setCity($chatid, $city, 'meeting_users');
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text']['сохранено']);
        $msg->replyHTML($json['text-meeting']['цель общения']);
        exit();
    } else {
        $msg->replyHTML($json['text']['города нет']);
        exit();
    }
}
