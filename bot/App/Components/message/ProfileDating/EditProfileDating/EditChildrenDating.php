<?php

if ($data[0] == 'set_children_dating' && $cmddating[0] == 'edit_children_dating') {
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
        $children = 'Другое';
    }
    $db->setCmd($chatid, 'edit_present_dating', 'dating_users');
    $db->setChildren($chatid, $children);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['подарок'], $present_btn_dating);
    exit();
}
