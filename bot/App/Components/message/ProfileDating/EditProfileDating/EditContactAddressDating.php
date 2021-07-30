<?php

if (!empty($message) && $cmddating[0] == 'edit_contact_address_dating') {

    $db->setCmd($chatid, 'edit_profile_dating','dating_users');
    $contactaddress = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setContactAddress($chatid,$contactaddress);
    clearCache($mem, $chatid);
    $msg->reply("Меню для редактирования анкеты", $profile_btn_dating);
    exit();
}
