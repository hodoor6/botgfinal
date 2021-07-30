<?php

if (!empty($message) && $cmddating[0] == 'edit_email_dating') {

    $email = $message;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $db->setCmd($chatid, 'edit_contact_address_dating', 'dating_users');
        $db->setEmail($chatid, $email);
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text-dating']['как с вами связаться адрес']);
        exit();
    } else {
        $msg->replyHTML($json['text-dating']['восстановления доступа email ошибка']);
        exit();
    }
}
