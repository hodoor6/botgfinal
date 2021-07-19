<?php

if (!empty($message) && $cmddating[0] == 'set_name_dating') {


    $db->setCmd($chatid, 'set_country_dating', 'dating_users');
    $name = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setName($chatid, $name);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['страна']);
    exit();
}
