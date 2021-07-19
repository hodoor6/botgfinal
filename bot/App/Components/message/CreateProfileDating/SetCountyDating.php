<?php


if ($cmddating[0] == 'set_country_dating' && !empty($message)) {

    $country = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    if (isCountry($country)) {
        $db->setCmd($chatid, 'set_city_dating', 'dating_users');
        $db->setCountry($chatid, $country, 'dating_users');
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text']['сохранено']);
        $msg->replyHTML($json['text-dating']['город']);
        exit();
    } else {
        $msg->replyHTML($json['text']['страны нет']);
        exit();
    }
}
