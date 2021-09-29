<?php

if ($data[0] == 'set_children_dating' && $cmddating[0] == 'set_children_dating_filter') {
    if ($data[1] == '1') {
        $children = 'Нет';
    } elseif ($data[1] == '2') {
        $children = 'Рано';
    } elseif ($data[1] == '3') {
        $children = 'Хочется';
    } elseif ($data[1] == '4') {
        $children = 'Есть и хочу ещё';
    } elseif ($data[1] == '5') {
        $children = 'Есть, больше не хочу';
    } elseif ($data[1] == '6') {
        $children = 'Не имеет значения';
    }
    $db->setCmd($chatid, 'set_find_country_dating_filter', 'dating_users');
    $db->setChildrenFilter($chatid, $children);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['страна поиска'],$find_country_btn_dating);
    exit();
}
