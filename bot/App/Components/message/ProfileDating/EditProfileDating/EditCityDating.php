<?php


if ($cmddating[0] == 'edit_city_dating' && !empty($message)) {
    $city = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');

    if ($db->isCity($city)) {
        $db->setCmd($chatid, 'edit_goal_communication_dating', 'dating_users');
        $db->setCity($chatid, $city, 'dating_users');
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text']['сохранено']);
        $msg->replyHTML($json['text-dating']['цель общения'], $goal_communication_btn_dating);
        exit();
    } else {
        $msg->replyHTML($json['text']['города нет']);
        exit();
    }
}
