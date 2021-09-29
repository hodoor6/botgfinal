<?php


    if ($cmddating[0] == 'set_city_meeting_filter' && !empty($message)) {
        $city = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');

        if ($db->isCity($city)) {
            $db->setCmd($chatid, '', 'dating_users');
            $db->setCityFilter($chatid, $city, 'meeting_users');
            clearCache($mem, $chatid);
            $msg->replyHTML($json['text']['сохранено']);
        } else {
            $msg->replyHTML($json['text']['города нет']);
            exit();
        }




    clearCache($mem, $chatid);
    $msg->replyHTML($json['text']['рег фильтр'], $meeting_btn_dating);
    clearCache($mem, $chatid);
    exit();
}
