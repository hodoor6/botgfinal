<?php

if ($data[0] == 'set_find_country' && $cmddating[0] == 'edit_find_country') {
    if ($data[1] == '1') {
        $country = 'Украина';
    } elseif ($data[1] == '2') {
        $country = 'Беларусь';
    } elseif ($data[1] == '3') {
        $country = 'Россия';
    } elseif ($data[1] == '4') {
        $country = 'Молдова';
    } elseif ($data[1] == '5') {
        $country = 'А вдруг это судьба?';
    }
    $db->setCmd($chatid, 'edit_email_dating', 'dating_users');
    $db->setFindCountry($chatid, $country);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['восстановления доступа email']);
    exit();
}
