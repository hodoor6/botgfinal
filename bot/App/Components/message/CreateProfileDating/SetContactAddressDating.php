<?php

if (!empty($message) && $cmddating[0] == 'set_contact_address_dating') {

    $db->setCmd($chatid, 'set_photo_dating','dating_users');
    $contactaddress = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setContactAddress($chatid,$contactaddress);
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['загрузите фото 1']);
    exit();
}
