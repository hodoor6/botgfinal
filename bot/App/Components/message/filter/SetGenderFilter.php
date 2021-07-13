<?php

if ($data[0] == 'set_gender' && $cmd[0] == 'set_gender_filter') {
    if ($data[1] == 'boy') {
        $gender = 1;
    } else {
        $gender = 2;
    }

    $db->setCmd($chatid, 'set_age_min_filter');
    $db->setGenderFilter($chatid, $gender);
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['фильтр возраст минимум']);
    exit();
}
