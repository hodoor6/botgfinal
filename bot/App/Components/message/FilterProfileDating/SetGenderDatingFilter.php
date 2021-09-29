
<?php

if ($data[0] == 'set_gender' && $cmddating[0] == 'set_gender_dating_filter') {
    if ($data[1] == 'boy') {
        $gender = 1;
    } else {
        $gender = 2;
    }

    $db->setCmd($chatid, 'set_age_min_dating_filter','dating_users');
    $db->setGenderFilter($chatid, $gender,'dating_users');
    clearCache($mem, $chatid);

    $msg->replyHTML($json['text']['фильтр возраст минимум']);
    exit();
}
