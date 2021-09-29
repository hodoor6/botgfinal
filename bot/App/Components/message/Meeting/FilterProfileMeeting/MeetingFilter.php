<?php

if ($message == $json['buttons']['фильтр-meeting'] && $cmd[0] == '' && $cmddating[0] == '') {


    //очищаем кеш
    clearCache($mem, $chatid);



    $db->setCmd($chatid, 'set_age_min_meeting_filter','dating_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text']['фильтр возраст минимум']);
    exit();
}
