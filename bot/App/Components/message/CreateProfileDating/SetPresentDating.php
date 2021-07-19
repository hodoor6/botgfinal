<?php

if ($data[0] == 'set_present_dating' &&  $cmddating[0] == 'set_present_dating' ) {

    if ($data[1] == '1') {
        $present = 'Утреннее кофе';
    } elseif($data[1] == '2') {
        $present = 'Пицца';
    }elseif($data[1] == '3') {
        $present = 'Салон красоты';
    }elseif($data[1] == '4') {
        $present = 'На мечту';
    }
    $db->setCmd($chatid, 'set_find_country','dating_users');
    $db->setPresent($chatid, $present);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['страна поиска'],$find_country_btn_dating);
    exit();
}
