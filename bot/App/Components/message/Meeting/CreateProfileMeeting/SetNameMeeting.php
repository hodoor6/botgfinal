<?php

if (!empty($message) && $cmddating[0] == 'set_name_meeting') {


    $db->setCmd($chatid, 'set_age_meeting', 'dating_users');
    $name = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setName($chatid, $name,'meeting_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-meeting']['сколько вам лет']);
    exit();
}
