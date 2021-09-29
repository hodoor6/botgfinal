<?php

if ($message == $json['buttons']['фильтр-dating'] && $cmd[0] == '' && $cmddating[0] == '') {


    //очищаем кеш
    clearCache($mem, $chatid);



    $db->setCmd($chatid, 'set_gender_dating_filter', 'dating_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text']['фильтр пол'], $gender_btn_filter);
    exit();
}
